# AllOfFilter

This filter accepts objects if all the provided filters also accepts the objects.

For example:

```php
class MyObject
{
    private $value;
    
    public function getOtherValue()
    {
        return 4;
    }
}

$objects = $funnel->findByAllOf(
    Funnel::propertyFilter('value', 4),
    Funnel::methodFilter('getOtherValue', 4)
);
```
