# MethodFilter

This filter accepts objects if the evaluation of the method is the
same as the provided value.

For example:

```php
class MyObject
{
    public function getValue()
    {
        return rand(0, 10);
    }
}

$objects = $funnel->findByMethod('getValue', 5);
```
