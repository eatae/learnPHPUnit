<?php

namespace Tests;

use App\Models\User;
use PHPUnit\Framework\Error\Error;
use PHPUnit\Framework\TestCase;


class StdOutTest extends TestCase
{
    /**
     * @var User
     */
    private $user;

    protected function setUp(): void
    {
        $this->user = new User('StdOutTest', 'test@email.com', '1234', 23);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function testOut()
    {
        // отслеживания вывода на экран
        $this->expectOutputString('Success');

        // вывели ожидаемую строку, тест пройден
        echo "Success";
    }


    public function testOutCallback()
    {
        // отслеживания вывода на экран
        $this->expectOutputString('Success');

        // функция которая получает вывод и как-то обрабатывает его
        $this->setOutputCallback(function($str) {
            // вернёт «Success», тест пройден
            return trim($str);
        });

        // вывели неправильную строку
        echo "Success ";
    }



}
