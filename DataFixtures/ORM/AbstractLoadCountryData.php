<?php

namespace LapaLabs\CountryBundle\DataFixtures\ORM;

use LapaLabs\CountryBundle\Model\AbstractCountry;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Intl\Intl;

/**
 * Class AbstractLoadCountryData
 */
class AbstractLoadCountryData implements ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var string
     */
    protected $locale;

    /**
     * @var string
     */
    protected $entityClass;

    /**
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @return ContainerInterface
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $locale = $this->defineLocale();
        $countries = Intl::getRegionBundle()->getCountryNames($locale);
        foreach ($countries as $code => $name) {
            $country = $this->createEntityClass();
            $country->setName($name);
            $country->setCode($code);
            $country->setPublished(true);
            $manager->persist($country);
        }

        $manager->flush();
    }

    /**
     * The locale
     *
     * @return string
     */
    private function defineLocale()
    {
        // use locale that manually set by user
        $locale = $this->locale;
        if (! $locale) {
            // use default locale from parameters.yml if not set
            $locale = $this->container->getParameter('locale');
        }

        return $locale;
    }

    /**
     * New entity object
     *
     * @return AbstractCountry
     */
    private function createEntityClass()
    {
        if (! class_exists($this->entityClass)) {
            throw new \RuntimeException(sprintf(
                'You should specify the existing Country class for load fixtures'
            ));
        }

        $entity = new $this->entityClass;

        if (! $entity instanceof AbstractCountry) {
            throw new \RuntimeException(sprintf(
                'The Country class should be extends from the %s',
                AbstractCountry::class
            ));
        }

        return $entity;
    }
}
