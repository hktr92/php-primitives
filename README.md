PHP Primitives
==============

PHP Primitives is an experimental library that is inspired from JavaScript / Python world.

They are just wrappers around primitive data types.

#### Why would you do that?
For me, it's just for fun. This would be my first project that is TDD-based.

Utility? It started from a project in which I defined a `StringUtil` class to make the basic case conversions. All methods in that class were static, so I had to do something like:
```php
<?php

class StringUtil {
    static $encoding = 'UTF-8';
    // ...
    public static function mbLoaded(): bool { return extension_loaded('mbstring'); }
    // ...
    public static function length(string $text, ?string $encoding): int {
        if (self::mbLoaded()) {
            return mb_strlen($text, $encoding ?? static::$encoding);
        }
        
        return strlen($text);
    }
    // ...
}
```

And, since I work *a lot* with JavaScript, I wanted to experiment some stuff.
Imagine: what if you could do something like this in PHP?
```javascript
// javascript
"foo".split();
"bar".concat("baz");
```
```python
# python

"foo".split()
"bar baz buzz".find("baz")
"bOo".islower()
```

#### Disclaimer
This library is not meant to be used in production. If you do use it... it's up to you.

#### Proof of concept
You can explore the features inside `examples/` directory.