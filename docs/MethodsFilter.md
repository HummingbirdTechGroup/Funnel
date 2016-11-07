# MethodsFilter

This filter accepts objects if the evaluation of all the provided
methods are the same as their corresponding values.

For example:

```php
class MyObject
{
    public function getLowerValue()
    {
        return rand(0, 10);
    }
    
    public function getUpperValue()
    {
        return rand(20, 30);
    }
}

$objects = $funnel->findByMethods([
    'getLowerValue' => 5,
    'getUpperValue' => 25
]);
```
