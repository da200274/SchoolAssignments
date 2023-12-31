<?php

namespace App\Models\Proxies\__CG__\App\Models\Entities;


/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Slika extends \App\Models\Entities\Slika implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array<string, null> properties to be lazy loaded, indexed by property name
     */
    public static $lazyPropertiesNames = array (
);

    /**
     * @var array<string, mixed> default values of properties to be lazy loaded, with keys being the property names
     *
     * @see \Doctrine\Common\Proxy\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array (
);



    public function __construct(?\Closure $initializer = null, ?\Closure $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', '' . "\0" . 'App\\Models\\Entities\\Slika' . "\0" . 'idSlika', '' . "\0" . 'App\\Models\\Entities\\Slika' . "\0" . 'komentar', '' . "\0" . 'App\\Models\\Entities\\Slika' . "\0" . 'putanja', '' . "\0" . 'App\\Models\\Entities\\Slika' . "\0" . 'brojLajkova', '' . "\0" . 'App\\Models\\Entities\\Slika' . "\0" . 'idZivotinja', '' . "\0" . 'App\\Models\\Entities\\Slika' . "\0" . 'lajkovi'];
        }

        return ['__isInitialized__', '' . "\0" . 'App\\Models\\Entities\\Slika' . "\0" . 'idSlika', '' . "\0" . 'App\\Models\\Entities\\Slika' . "\0" . 'komentar', '' . "\0" . 'App\\Models\\Entities\\Slika' . "\0" . 'putanja', '' . "\0" . 'App\\Models\\Entities\\Slika' . "\0" . 'brojLajkova', '' . "\0" . 'App\\Models\\Entities\\Slika' . "\0" . 'idZivotinja', '' . "\0" . 'App\\Models\\Entities\\Slika' . "\0" . 'lajkovi'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Slika $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy::$lazyPropertiesDefaults as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load(): void
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized(): bool
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized): void
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null): void
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer(): ?\Closure
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null): void
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner(): ?\Closure
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @deprecated no longer in use - generated code now relies on internal components rather than generated public API
     * @static
     */
    public function __getLazyProperties(): array
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getIdSlika()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getIdSlika();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIdSlika', []);

        return parent::getIdSlika();
    }

    /**
     * {@inheritDoc}
     */
    public function setKomentar($komentar)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setKomentar', [$komentar]);

        return parent::setKomentar($komentar);
    }

    /**
     * {@inheritDoc}
     */
    public function getKomentar()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getKomentar', []);

        return parent::getKomentar();
    }

    /**
     * {@inheritDoc}
     */
    public function setPutanja($putanja)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPutanja', [$putanja]);

        return parent::setPutanja($putanja);
    }

    /**
     * {@inheritDoc}
     */
    public function getPutanja()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPutanja', []);

        return parent::getPutanja();
    }

    /**
     * {@inheritDoc}
     */
    public function setBrojLajkova($brojLajkova)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setBrojLajkova', [$brojLajkova]);

        return parent::setBrojLajkova($brojLajkova);
    }

    /**
     * {@inheritDoc}
     */
    public function getBrojLajkova()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getBrojLajkova', []);

        return parent::getBrojLajkova();
    }

    /**
     * {@inheritDoc}
     */
    public function setIdZivotinja(\App\Models\Entities\Zivotinja $idZivotinja = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIdZivotinja', [$idZivotinja]);

        return parent::setIdZivotinja($idZivotinja);
    }

    /**
     * {@inheritDoc}
     */
    public function getIdZivotinja()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIdZivotinja', []);

        return parent::getIdZivotinja();
    }

    /**
     * {@inheritDoc}
     */
    public function addLajkovi(\App\Models\Entities\Lajkovi $lajkovi)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addLajkovi', [$lajkovi]);

        return parent::addLajkovi($lajkovi);
    }

    /**
     * {@inheritDoc}
     */
    public function removeLajkovi(\App\Models\Entities\Lajkovi $lajkovi)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeLajkovi', [$lajkovi]);

        return parent::removeLajkovi($lajkovi);
    }

    /**
     * {@inheritDoc}
     */
    public function getLajkovi()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLajkovi', []);

        return parent::getLajkovi();
    }

}
