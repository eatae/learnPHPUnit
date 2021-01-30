<?php


namespace App\Patterns\Observer_z;


class SecurityMonitor extends AbstractLoginObserver
{
    public function doUpdate(Login $login)
    {
        $status = $login->getStatus ();
        if ( $status[0] == Login::LOGIN_WRONG_PASS ) {
            // послать сообщение по электронной почте
            // системному администратору
            print __CLASS__ . ":Отправка почты системному администратору\n";
        }
    }

}
