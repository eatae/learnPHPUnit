<?php declare(strict_types=1);

namespace App\Patterns\Observer;

use SplSubject;
use SplObjectStorage;
use SplObserver;

class User implements SplSubject
{
    private string $email;
    private SplObjectStorage $observers;

    public function __construct()
    {
        $this->observers = new SplObjectStorage();
    }

    public function attach(SplObserver $observer)
    {
        $this->observers->attach($observer);
    }

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

    public function changeEmail(string $email) {
        $this->email = $email;
        $this->notify();
    }


}
