<?php

namespace Tests;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
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

    /* вызывается после выполнения каждого теста
     * здесь обнуляем объекты с которыми работали (очищаем память)
     */
    protected function tearDown(): void
    {

        parent::tearDown();
    }


    public function ageProvider()
    {
        return [
            'incorrect' => [22],
            'correct' => [23]
        ];
    }
    /**
     * @dataProvider ageProvider
     */
    public function testAge($age)
    {
        // проверяем равество
        $this->assertEquals($age, $this->user->getAge());
        return 22;
    }

    public function testOne()
    {
        return 100;
    }

    /**
     * @depends testOne
     */
    public function testTwo($param)
    {
        $this->assertEquals($param, 100);
    }



    public function userProvider()
    {
        return [
           'incorrect' => ['IncorrectName', 'test@email.com'],
            'correct' => ['TestName', 'test@email.com']
        ];
    }

    /**
     * @dataProvider userProvider
     */
    public function testUser($name, $email)
    {
        $this->assertEquals($name, $this->user->getName());
        $this->assertEquals($email, $this->user->getEmail());
    }




    public function testPass()
    {
        // этот тест провалится
        $this->assertEquals('1234', $this->user->getPass());
    }
}
