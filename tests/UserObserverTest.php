<?php

namespace Tests;

use App\Models\User;
use App\Models\UserObserver;
use PHPUnit\Framework\TestCase;


class UserObserverTest extends TestCase
{

    /**
     * @var User
     */
    private $user;


    /* вызывается перед каждым тестом
     * здесь инициализируем необходимые объекты
     */
    protected function setUp(): void
    {
        $this->user = new User('TestName', 'test@email.com', '1234', 23);
    }

    public function testObserver()
    {
        $observer = $this->getMockBuilder(UserObserver::class)
            ->onlyMethods(['update'])
            ->getMock();
        /* настраиваем поведение метода Mock:
         * - ожидаем один вызов метода 'update' и ожидаем $user в качестве параметра
         */
        $observer->expects($this->once())->method('update')
            ->with( $this->callback(function($param){
                return $this->user == $param;
            }));

        $this->user->attach($observer);
        $this->user->setName('AnyName');
    }


}
