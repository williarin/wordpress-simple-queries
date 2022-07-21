<?php
/**
 * Plugin Name: Simple Queries
 * Plugin URI:  https://github.com/williarin/wordpress-simple-queries
 * Description: Query the database in your plugins and templates using WordpressInterop library.
 * Version:     {plugin-version}
 * Author:      William Arin
 * Author URI:  https://github.com/williarin
 * License:     GPL-3.0
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Domain Path: /languages/
 * Requires at least: 5.6
 * Requires PHP: 8.0
 **/

declare(strict_types=1);

use Williarin\SimpleQueries\SimpleQuery;
use Williarin\SimpleQueries\Vendor\Williarin\WordpressInterop\EntityManagerInterface;

if (!defined('ABSPATH')) {
    exit;
}

if (
    !defined('DB_USER')
    || !defined('DB_PASSWORD')
    || !defined('DB_HOST')
    || !defined('DB_NAME')
    || !defined('DB_CHARSET')
) {
    return;
}

const SIMPLE_QUERIES_ENABLED = true;

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require __DIR__ . '/vendor/autoload.php';
}

if (!function_exists('SimpleQuery')) {
    function SimpleQuery(): EntityManagerInterface
    {
        return SimpleQuery::getInstance()->getManager();
    }
}
