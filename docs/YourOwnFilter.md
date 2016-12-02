# Create your own filter

Funnel filters are a bit tricky to create.

They must implement `carlosV2\Funnel\FilterInterface` which require the following methods:

- getName
- getFilter

The `getFilter` method needs to return a callback function defining the needed parameters which,
at the same time, it also needs to return a nested callback accepting the object as
the single parameter.

For instance, here is an example for a date range filter:

```php
use carlosV2\Funnel\FilterInterface;

final class DateRangeFilter implements FilterInterface
{
    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'dateRange';
    }

    /**
     * @inheritDoc
     */
    public function getFilter()
    {
        return function ($method, \DateTime $lower, \DateTime $upper) {
            return function ($object) use ($method, \DateTime $lower, \DateTime $upper) {
                $date = $object->$method();
                
                return $date >= $lower && $date <= $upper; 
            };
        };
    }
}
```

Bear in mind that the returned name will be used for composing the new methods.

For example:
- findByDateRange('getMethod', new \DateTime('07/11/2016'), new \DateTime('08/11/2016'))
- findOneByDateRange('getMethod', new \DateTime('07/11/2016'), new \DateTime('08/11/2016'))
- countByDateRange('getMethod', new \DateTime('07/11/2016'), new \DateTime('08/11/2016'))

Finally, in order to make it available, you need to add it into Funnel:

```php
Funnel::addFilter(new DateRangeFilter());
```
