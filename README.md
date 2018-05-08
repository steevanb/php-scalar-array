[![version](https://img.shields.io/badge/version-1.0.1-green.svg)](https://github.com/steevanb/php-typed-array/tree/1.0.1)
[![php](https://img.shields.io/badge/php-^7.1-blue.svg)](https://php.net)
![Lines](https://img.shields.io/badge/code%20lines-407-green.svg)
![Total Downloads](https://poser.pugx.org/steevanb/php-typed-array/downloads)
[![Scrutinizer](https://scrutinizer-ci.com/g/steevanb/php-typed-array/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/steevanb/php-typed-array/)

### php-typed-array

Bored of not knowing value type in array ? You are at right spot !

With `php-typed-array`, you can type your array values. How ? Cause now you will use object instead of array, who can control their values.

[Changelog](changelog.md)

### Installation

```
composer require steevanb/php-typed-array ^1.0
```

### Usage

/!\ DO NOT USE WITH `array_key_exists()` /!\

As PHP have a bug with `\ArrayAccess`, `offsetExists()` is not called by `array_key_exists()`:
```php
$intArray = new IntArray(['foo' => 18);
// will always return false, although key exist
array_key_exists('foo', $intArray);
// use isset() instead, who call \ArrayAccess::offsetExists() properly
isset($intArray['foo']);
```

Simple usage:
```php
$intArray = new IntArray([1, 2]);
$intArray['key'] = 3;
foreach ($intArray as $key => $int) {
    // do your stuff, you are SURE $int is integer !
}
```

Usefull usage:
```php
function returnInts(): \IntArray
{
    return new \IntArray([1, 2, 3); 
}

foreach (returnInts() as $key => $int) {
    // do your stuff, you are SURE $int is integer !
}
```

Will throw `\Exception`, cause `'foo'` is not allowed:
```php
$intArray = new IntArray([1, 2, 'foo']);
```

### Typed array available

`\IntArray`: can only store `int`

`\IntNullableArray`: can store `int` and `null`

`\StringArray`: can only store `string`

`\StringNullableArray`: can only `string` and `null`

`\ObjectArray`: can only store `object`

### \ObjectArray

If you need to store objects in array, you can use `\ObjectArray`.

But if you need to be sure each objects are instance of something, you can configure it in `__construct()`:

```php
$dateTimeArray = new \ObjectArray([new \DateTime()], \DateTime::class);
```

Or you can extend `\ObjectArray` and configure it internaly:

```php
class DateTimeArray extends \ObjectArray
{
    public function __construct(iterable $values = [])
    {
        parent::__construct($values, \DateTime::class);
    }
}
```

### Limitations

As `\Iterator` PHP interface need `next()` method, and we have to use `next()` PHP function here, who return `false` : `BoolArray` could not exists.
