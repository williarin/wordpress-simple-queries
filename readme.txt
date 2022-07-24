=== Simple Queries ===
Contributors: williarin
Tags: database, query, dbal, oop
Requires at least: 5.6
Tested up to: 6.0.1
Stable tag: {plugin-version}
Requires PHP: 8.0
License: GPL-3.0
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Query the database in your plugins and themes using WordpressInterop library.

== Description ==

Once the plugin is activated, you'll be able to use the `SimpleQuery()` function which gives you the `EntityManager`.
For more details on how to use the library, see [WordpressInterop](https://github.com/williarin/wordpress-interop) documentation.

This plugin is purely made for developers to build themes or plugins using this library.

Features overview:
* basic and advanced querying (posts, postmeta, terms, options, etc.)
* columns selection
* nested conditions
* operators (LIKE, RLIKE, IN, NOT IN, etc.)
* basic field update
* post meta update
* entity persistence (no change tracking, very basic)
* add or remove terms to/from an entity
* WooCommerce support
* entity duplication (including all post meta and terms)
* extensibility for your own custom types

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

== Frequently Asked Questions ==

= How to use this plugin in my code? =

Anytime you want to make a call to the database, you need to retrieve the `EntityManager`. This is done by calling the `SimpleQuery()` function.

```php
// Fetch all products with id and sku columns only
$products = SimpleQuery()->getRepository(Product::class)
    ->findBy([new SelectColumns(['id', 'sku'])]);
```

For more details on how to use the WordpressInterop library, see [WordpressInterop](https://github.com/williarin/wordpress-interop) documentation.

= Do I need composer to use this plugin? =

No. You can directly use it in your code.

= What benefits this plugin gives me compared to WP_Query? =

You can write complex queries with a simple syntax which looks like Doctrine ORM, although it's not an ORM.
This plugin uses Doctrine DBAL and you can easily extend the query builder if you're familiar with DBAL.

== Changelog ==

= 1.0.0.1.10.0 =
* Initial release featuring WordpressInterop 1.10.0
