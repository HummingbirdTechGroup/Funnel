# Funnel

Little testing repositories enhancer.

[![License](https://poser.pugx.org/carlosv2/funnel/license)](https://packagist.org/packages/carlosv2/funnel)
[![Build Status](https://travis-ci.org/carlosV2/Funnel.svg?branch=master)](https://travis-ci.org/carlosV2/Funnel)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/99bf9a7b-9620-4b42-91e5-d943fed7862c/mini.png)](https://insight.sensiolabs.com/projects/99bf9a7b-9620-4b42-91e5-d943fed7862c)

This project aims to provide quick and easy filtering capabilities to [everzet/persisted-objects](https://github.com/everzet/persisted-objects).

## Usage

You just need to decorate the testing repository with `carlosV2\Funnel\Funnel`. For example:

```php
use carlosV2\Funnel\Funnel;
use Everzet\PersistedObjects\Repository;

class MyTestingRepository
{
    /**
     * @var Funnel
     */
    private $repository;
    
    /**
     * @param Repository $repository
     */
    public function __construct(Repository $repository)
    {
        $this->repository = new Funnel($repository);
    }
    
    // ...
}
```

Funnel also implements `Everzet\PersistedObjects\Repository` so you don't lose any feature
and yet you gain some more instead:

- findAll(): Returns an array with all the objects. This is an alias for `getAll`.
- findBy(callable): Returns an array with all the matching objects. Empty array is returned if none is found.
- findOneBy(callable): Returns the first matching object or null if none is found.
- countBy(callable): Returns an integer representing the number of matching objects.

For example:

```php
$objects = $funnel->findBy(function ($object) {
    return $object->getData() === 'foo';
});
```

In addition, Funnel provides some generic filters that can be used to speed up development:

- [MethodFilter](https://github.com/carlosV2/Funnel/blob/master/docs/MethodFilter.md)
- [MethodsFilter](https://github.com/carlosV2/Funnel/blob/master/docs/MethodsFilter.md)
- [PropertyFilter](https://github.com/carlosV2/Funnel/blob/master/docs/PropertyFilter.md)
- [PropertiesFilter](https://github.com/carlosV2/Funnel/blob/master/docs/PropertiesFilter.md)
- [TypeFilter](https://github.com/carlosV2/Funnel/blob/master/docs/TypeFilter.md)
- [BeingFilter](https://github.com/carlosV2/Funnel/blob/master/docs/BeingFilter.md)
- [HavingFilter](https://github.com/carlosV2/Funnel/blob/master/docs/HavingFilter.md)

Those filters can be used by composing a new method applying the following rule (where "Not" is optional):

```
   find |
findOne > + By + [Not] + Filter
  count |
```

For example:

- findByProperty(...): Finds all the objects that have the given property and value.
- findOneByMethod(...): Finds the first object that matches the given method and value.
- countByNotType(...): Counts all the objects that don't have the given type.

If none of the provided filters match your requirements, you can also add [your own filters](https://github.com/carlosV2/Funnel/blob/master/docs/YourOwnFilter.md)
to Funnel to make them available when composing new methods.

Feel free to create a pull request with your own generic filters! :)

## Install

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this project:

```bash
$ composer require carlosv2/funnel
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.
