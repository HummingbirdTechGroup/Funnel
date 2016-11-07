# BeingFilter

This filter accepts objects if they are in the expected status.

For example:

```php
class MyObject
{
    private $items = [];

    public function isEmpty()
    {
        return count($this->items) === 0;
    }
    
    public function isBiggerThan(array $items)
    {
        return count($this->items) > count($items);
    }
}

$objects = $funnel->findByBeing('empty');
$objects = $funnel->findByBeing('biggerThan', ['A', 'B']);
```
