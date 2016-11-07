# TypeFilter

This filter accepts objects if they have the provided type.

For example:

```php
class MyObject
{
}

$objects = $funnel->findByType(MyObject::class);
```
