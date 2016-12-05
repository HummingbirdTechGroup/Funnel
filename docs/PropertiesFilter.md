# PropertiesFilter

This filter accepts objects if the values of all the provided
properties are the same as their corresponding ones.

For example:

```php
class MyObject
{
    public $lowerValue;
    
    private $upperValue;
}

$objects = $funnel->findByProperties([
    'lowerValue' => 5,
    'upperValue' => 25
]);
```

Note: It works for any property type being `public`, `protected`, `private`
as well as those allocated dynamically.
