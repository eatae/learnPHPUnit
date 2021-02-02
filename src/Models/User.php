<?php

namespace App\Models;

use SplSubject;
use SplObserver;
use SplObjectStorage;


class User implements SplSubject
{
    private $name;
    private $email;
    private $pass;
    private $age;

    public $foo = 'bar';

    private $observers;
    /**
     * User constructor.
     * @param $name
     * @param $email
     * @param $pass
     * @param $age
     */
    public function __construct($name = null, $email = null, $pass = null, $age = null)
    {
        $this->name = $name;
        $this->email = $email;
        $this->pass = $pass;
        $this->age = $age;
        $this->observers = new SplObjectStorage();
    }

    /**
     * @param SplObserver $observer
     */
    public function attach(SplObserver $observer)
    {
        $this->observers->attach($observer);
    }

    /**
     * @param SplObserver $observer
     */
    public function detach(SplObserver $observer)
    {
        $this->observers->detach($observer);
    }


    public function notify()
    {
        /** @var SplObserver $observer */
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }


    /**
     * Name
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
        $this->notify();
    }

    /**
     * Email
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * Pass
     *
     * @return mixed
     */
    public function getPass()
    {
        return $this->pass;
    }
    /**
     * @param mixed $pass
     */
    public function setPass($pass): void
    {
        $this->pass = $pass;
    }

    /**
     * Age
     *
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }
    /**
     * @param mixed $age
     */
    public function setAge($age): void
    {
        $this->age = $age;
    }


    public function save(Db $db)
    {
        if ( !$db->connect() ) {
            return false;
        }
        return true;
    }

}
