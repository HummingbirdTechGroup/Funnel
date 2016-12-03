# AnyOfFilter

This filter accepts objects if at least one of the provided filters also accepts the objects.

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

$objects = $funnel->findByAnyOf(
    Funnel::propertyFilter('value', 4),
    Funnel::methodFilter('getOtherValue', 4)
);
```
