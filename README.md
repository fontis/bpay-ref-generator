Fontis BPAY Customer Ref Generator
==================================

This package provides a convenient way of generating customer reference numbers
for BPAY. There are functions to calculate reference numbers based on both the
MOD 10 Version 1 and MOD 10 Version 5 algorithms.

The recommended way to install this package is using [Composer](https://getcomposer.org).
If you don't already have Composer installed, you can install it using the
instructions mentioned on the [Composer documentation](https://getcomposer.org/doc/00-intro.md).
Once you have composer installed, just install it like so:

```bash
composer require fontis/bpay-ref-generator 1.0.*
```

Using this package is very simple. Instantiate an instance of the Generator
class like so:

```php
use Fontis\BpayRefGenerator\Generator;

$generator = new Generator();
```

Then call the appropriate method based on which algorithm you want to use.
For MOD 10 Version 1:

```php
$ref = $generator->calcMod10V1("10000456");
// 100004563
```

For MOD 10 Version 5:

```php
$ref = $generator->calcMod10V5("40007923");
// 400079231
```
