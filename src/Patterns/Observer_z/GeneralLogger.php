<?php


namespace App\Patterns\Observer_z;


class GeneralLogger extends AbstractLoginObserver
{
    public function doUpdate(Login $login)
    {
        $status = $login->getStatus();
        // записать данные регистрации в системный журнал
        print __CLASS__ . ":Регистрация в системном журнале\п";
    }

}
