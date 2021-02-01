<?php

namespace Tests;

use App\Models\User;
use App\Models\UserObserver;
use \Mockery;
use App\Models\Db;
use PHPUnit\Framework\TestCase;


class MockeryTest extends TestCase
{

    /**
     * @var User
     */
    private $user;

    protected function setUp(): void
    {
        $this->user = new User('StdOutTest', 'test@email.com', '1234', 23);
    }


    public function testMockeryOne()
    {
        $db = Mockery::mock(Db::class);
        // задали метод и возвращаемое значение
        $db->shouldReceive('connect')->andReturn(true);

        $this->assertTrue( $this->user->save($db) );
    }


    public function testMockeryTwo()
    {
        $observer = Mockery::mock(UserObserver::class);
        // будем вызывать метод update с параметром user, один раз
        $observer->shouldReceive('update')->with($this->user);

        $this->user->attach($observer);
        $this->user->setName('SomeName');

        $this->assertEquals($this->user->getName(), 'SomeName');
    }
}
