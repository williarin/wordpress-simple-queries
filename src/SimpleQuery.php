<?php

declare(strict_types=1);

namespace Williarin\SimpleQueries;

use Williarin\SimpleQueries\Vendor\Doctrine\Common\Annotations\AnnotationReader;
use Williarin\SimpleQueries\Vendor\Doctrine\DBAL\DriverManager;
use Williarin\SimpleQueries\Vendor\Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Williarin\SimpleQueries\Vendor\Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Williarin\SimpleQueries\Vendor\Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Williarin\SimpleQueries\Vendor\Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Williarin\SimpleQueries\Vendor\Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Williarin\SimpleQueries\Vendor\Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Williarin\SimpleQueries\Vendor\Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Williarin\SimpleQueries\Vendor\Symfony\Component\Serializer\Serializer;
use Williarin\SimpleQueries\Vendor\Williarin\WordpressInterop\EntityManager;
use Williarin\SimpleQueries\Vendor\Williarin\WordpressInterop\EntityManagerInterface;
use Williarin\SimpleQueries\Vendor\Williarin\WordpressInterop\Serializer\SerializedArrayDenormalizer;

final class SimpleQuery
{
    private static ?SimpleQuery $instance = null;
    private EntityManagerInterface $manager;

    public static function getInstance(): self
    {
        if (!self::$instance) {
            self::$instance = new SimpleQuery();
        }

        return self::$instance;
    }

    public function __construct()
    {
        $connection = DriverManager::getConnection([
            'dbname' => constant('DB_NAME'),
            'user' => constant('DB_USER'),
            'password' => constant('DB_PASSWORD'),
            'host' => constant('DB_HOST'),
            'charset' => constant('DB_CHARSET'),
            'driver' => 'mysqli',
        ]);

        $objectNormalizer = new ObjectNormalizer(
            new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader())),
            new CamelCaseToSnakeCaseNameConverter(),
            null,
            new ReflectionExtractor()
        );

        $serializer = new Serializer([
            new DateTimeNormalizer(),
            new ArrayDenormalizer(),
            new SerializedArrayDenormalizer($objectNormalizer),
            $objectNormalizer,
        ]);

        $this->manager = new EntityManager($connection, $serializer);
    }

    public function getManager(): EntityManagerInterface
    {
        return $this->manager;
    }
}
