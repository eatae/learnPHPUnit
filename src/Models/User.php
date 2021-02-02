<?php

namespace App\Models;

use SplSubject;
use SplObserver;
use SplObjectStorage;


class User implements SplSubject
{

    public const STATUS_WAIT = '0';
    public const STATUS_ACTIVE = '1';

    private $id;
    private $name;
    private $email;
    private $pass;
    private $isActive;

    private $db;
    private $observers;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->db = Db::get_instance();
        $this->db->setConnection('phpunit-mysql','root','2222','phpunit');

        $this->observers = new SplObjectStorage();
    }

    /**
     * @param $name
     * @param $email
     * @param $password
     * @return User
     */
    public function register($name, $email, $password) {
        $sql = "INSERT INTO users SET name='".$name."',email='".$email."',password='".md5($password)."'";
        $this->db->query($sql);

        $this->setId( $this->db->getlastId() );
        return $this->find($this->getId());
    }

    /**
     * @param $id
     * @return $this
     */
    public function find($id) {
        $sql = "SELECT * FROM users WHERE id = '" . $id ."' LIMIT 1";
        $result = $this->db->query($sql);
        if($result) {
            $row = $result->fetch_array();
            $this->setName($row['name']);
            $this->setPassword($row['password']);
            $this->setEmail($row['email']);
            $this->setIsActive($row['is_active']);
        }
        return $this;
    }



    /**
     * Is Active
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->getIsActive() === self::STATUS_ACTIVE;
    }

    /**
     * Is Wait
     * @return bool
     */
    public function isWait(): bool
    {
        return $this->getIsActive() === self::STATUS_WAIT;
    }


    /**
     * @throws \Exception
     */
    public function verify(): void
    {
        if (!$this->isWait()) {
            throw new \Exception('User verified');
        }
        $sql = "UPDATE  users SET is_active='".self::STATUS_ACTIVE."' WHERE id = '" . $this->getId() . "'";
        $this->db->query($sql);
        $this->setIsActive(self::STATUS_ACTIVE);
    }



    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
        //@codeCoverageIgnoreStart
        if(empty($this->email)) {
            throw new InvalidArgumentException("message",10);
        }
        //@codeCoverageIgnoreEnd
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
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->isActive;
    }
    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
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

}
