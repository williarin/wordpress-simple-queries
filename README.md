# Simple Queries

## Introduction

This WordPress plugin integrates [williarin/wordpress-interop](https://github.com/williarin/wordpress-simple-queries) in WordPress.

## Requirements

You must have WordPress running on PHP 8.0 or later, so WordPress 5.6 or later.

## Installation

### WordPress

Install it through WordPress admin → Plugins → New → Simple Queries.

### Filesystem

Download the latest release on this page and extract it in `yourproject/wp-content/plugins/simple-queries/`.

## Usage

Once the plugin is activated, you'll be able to use the `SimpleQuery()` function which gives you the `EntityManager`.
For more details, see [williarin/wordpress-interop](https://github.com/williarin/wordpress-interop) documentation.

Example:
```php
use Williarin\SimpleQueries\Vendor\Williarin\WordpressInterop\Bridge\Entity\Product;

if (!defined('SIMPLE_QUERIES_ENABLED') || !SIMPLE_QUERIES_ENABLED) {
    return;
}

// Fetch all products with id and sku columns only
$products = SimpleQuery()->getRepository(Product::class)
    ->findBy([new SelectColumns(['id', 'sku'])]);
```

## License

[GPL 3.0](LICENSE.txt)

Copyright (c) 2022, William Arin
