<?php

namespace App\Models;

use SplObserver;
use SplSubject;

class UserObserver implements SplObserver
{

    public function update(SplSubject $subject)
    {
        print __CLASS__ .": Отследили изменение состояния\n";
    }

}
