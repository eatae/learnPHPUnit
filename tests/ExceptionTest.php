<?php

namespace Tests;

use App\Models\User;
use PHPUnit\Framework\Error\Error;
use PHPUnit\Framework\TestCase;


class ExceptionTest extends TestCase
{
    /**
     * @var User
     */
    private $user;


    /*
     * вызывается перед каждым методом теста
     * здесь инициализируем необходимые объекты
     */
    protected function setUp(): void
    {
        $this->user = new User('ExceptionTestName');
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    private function checkUserEmail()
    {
        if (null == $this->user->getEmail()) {
            throw new \Exception('Empty email');
        }
    }

    /**
     * Test Exception
     *
     * @throws \Exception
     */
    public function testEmailException()
    {
        // говорим, что ожидаем Exception
        $this->expectException(\Exception::class);

        // метод выбрасывает Exception, тест пройден
        $this->checkUserEmail();
    }

    /**
     * Test Error
     *
     * @throws \Exception
     */
    public function testError()
    {
        // говорим, что ожидаем Error
        $this->expectError();

        // получаем ошибку, тест пройден
        include 'some_file.txt';
    }

}
