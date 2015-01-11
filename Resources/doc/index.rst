Country Bundle
==============

The bundle with abstract Country entity based on Country's data of Symfony
(Intl Component)[http://symfony.com/doc/current/components/intl.html]
used for fixtures that load to database for easy entity relating and less DB redundant data.

Install
-------

Install bundle with `Composer` dependency manager first by running the command:

`$ composer require "lapalabs/country-bundle:dev-master"`

Include
-------

Enable the bundle in application kernel for `prod` environment:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // other bundles...
        new LapaLabs\CountryBundle\LapaLabsCountryBundle(),
    );
}
```

Create your Country class
-------------------------

``` php
<?php

namespace Acme\CountryBundle\Entity;

use LapaLabs\CountryBundle\Model\AbstractCountry as BaseCountry;
use Doctrine\ORM\Mapping as ORM;

/**
 * Country
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class Country extends BaseCountry
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
}
```

Create your Country fixtures loader
------------------------------------

``` php
<?php

namespace Acme\CountryBundle\DataFixtures\ORM;

use LapaLabs\CountryBundle\DataFixtures\ORM\AbstractLoadCountryData;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadCountryData
 */
class LoadCountryData extends AbstractLoadCountryData implements FixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // $this->locale = 'uk'; // Preferred locale in which store data to DB (used locale from parameters.yml by default)
        $this->entityClass = \Acme\CountryBundle\Entity\Country::class; // Your entity class name
        parent::load($manager);
    }
}
```

Update database schema
----------------------

``` bash
$ php app/console doctrine:schema:update --force
```

Load fixtures
-------------

``` bash
$ php app/console doctrine:fixtures:load
```

Congratulations!
----------------
You're ready to use it!
