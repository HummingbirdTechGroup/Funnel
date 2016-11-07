# HavingFilter

This filter accepts objects if they have an expected status.

For example:

```php
class MyObject
{
    private $paths = [];

    public function hasRoot()
    {
        return $this->hasPath('/');
    }
    
    public function hasPath($path)
    {
        return array_search($path, $this->paths) !== false;
    }
}

$objects = $funnel->findByHaving('root');
$objects = $funnel->findByHaving('path', '/my/path');
```
