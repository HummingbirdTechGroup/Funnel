# PropertyFilter

This filter accepts objects if the value of the property is the
same as the provided value.

For example:

```php
class MyObject
{
    private $value;
}

$objects = $funnel->findByProperty('value', 5);
```

Note: It works for any property type being `public`, `protected`, `private`
as well as those allocated dynamically.
