<?php


namespace App\Patterns\Observer_z;


class PartnershipTool extends AbstractLoginObserver
{
    public function doUpdate(Login $login)
    {
        $status = $login->getStatus();
        // проверяем IP-адрес
        // отправим cookie-файл, если адрес соответствует списку
        print __CLASS__ .": Отправка cookie-файла, если адрес соответствует списку\n";
    }

}
