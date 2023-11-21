

# Utility methods for PHP

[![Minimum PHP Version](https://img.shields.io/badge/PHP-%3E%3D%208.2-yellow)](https://php.net/)
[![License](https://sqonk.com/opensource/license.svg)](license.txt)

A minimal library of global utility functions for working with strings and arrays. Currently only a handful of methods are present.


Generally the methods in this library have a basic rule of thumb:

- Solve a problem or provide an operation not handled directly by the PHP standard library.
- To that end, not duplicate a method or be an alias to a built-in method unless it provides a specific benefit.
- Have a wide applicable use across both web applications and CLI programming.

Some of the methods overlap with PHEXT-Core but will only be declared when the latter is not present, allowing the two to coexist.


## Install

Via Composer

``` bash
$ composer require sqonk/php-utils
```



API Reference
------------

[Available here](docs/api/strings.md).




## Credits

Theo Howell



## License

The MIT License (MIT). Please see [License File](license.txt) for more information.