<?php

namespace Tests\User;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{

    /**
     * @var User
     */
    private $user;


    /*
     * вызывается перед каждым тестом
     * здесь инициализируем необходимые объекты
     */
    protected function setUp(): void
    {
        /* create Mock */
        $this->user = $this->getMockBuilder(User::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->disallowMockingUnknownTypes()
            ->getMock();

        /* create returned value for method register */
        $returnedUser = new User();
        $returnedUser->setName("Return");
        $returnedUser->setEmail("return@mail.com");
        $returnedUser->setPass(md5("1234"));
        $returnedUser->setIsActive("0");

        $this->user->method('register')->willReturn($returnedUser);
    }

    /*
     * вызывается после выполнения каждого теста
     * здесь обнуляем объекты с которыми работали (очищаем память)
     */
    protected function tearDown(): void
    {
        parent::tearDown();
    }


    /**
     * Provider
     * @return array
     */
    public function additionProvider()
    {
        return [
            ['Return', 'return@mail.com', '1234']
        ];
    }


    /**
     * @dataProvider additionProvider
     */
    public function testRegister($name, $email, $pass)
    {
        /* create new User */
        $user = $this->user->register($name, $email, $pass);

        /* testing */
        $this->assertNotEmpty($user);
        // проверяем имя
        $this->assertEquals($name, $user->getName());
        // проверяем email
        $this->assertEquals($email, $user->getEmail());
        // сохранился ли пароль в БД
        $this->assertNotEmpty($user->getPass());
        // захешировался ли он
        $this->assertNotEquals($pass, $user->getPass());
        // пользователь при регистрации должен остаться не активным
        $this->assertFalse($user->isActive());
    }


    public function testVerify($name, $email, $pass)
    {
        /* create new User */
        $user = $this->user->register($name, $email, $pass);
        $user->verify();
        /* testing */
        $this->assertTrue($user->isActive());
        // Exception при повторной верификации
        $this->expectException(\Exception::class);
        $user->verify();
    }
}
