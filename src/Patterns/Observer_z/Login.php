<?php

namespace App\Patterns\Observer_z;

use SplObserver;
use SplSubject;


class Login implements SplSubject
{
    const LOGIN_USER_UNKNOWN = 1;
    const LOGIN_WRONG_PASS = 2;
    const LOGIN_ACCESS = 3;

    private array $observers = [];
    private $storage;
    private array $status = [];

    public function attach(SplObserver $observer)
    {
        $this->observers[] = $observer;
    }

    public function detach(SplObserver $observer)
    {
        $this->observers = array_filter($this->observers, function($item) use ($observer) {
            return (! ($item == $observer));
        });
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }


    public function handleLogin(string $user, string $pass, string $ip): bool
    {
        $isValid = false;

        switch (rand(1, 3)) {
            case 1:
                $this->setStatus(self::LOGIN_ACCESS, $user, $ip);
                $isValid = true;
                break;
            case 2:
                $this->setStatus(self::LOGIN_WRONG_PASS, $user, $ip);
                $isValid = false;
                break;
            case 3:
                $this->setStatus(self::LOGIN_USER_UNKNOWN, $user, $ip);
                $isValid = false;
                break;
        }
        $this->notify();

        return $isValid;
    }


    private function setStatus(int $status, string $user, string $ip)
    {
        $this->status = [$status, $user, $ip];
    }


    public function getStatus(): array
    {
        return $this->status;
    }

}
