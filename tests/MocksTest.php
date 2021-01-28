<?php

namespace Tests;

use App\Models\Db;
use App\Models\User;
use phpDocumentor\Reflection\Types\This;
use PHPUnit\Framework\Error\Error;
use PHPUnit\Framework\TestCase;


class MocksTest extends TestCase
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


    public function testMakeMock()
    {
        // создали Mock Db
        $db = $this->createMock(Db::class);

        $this->markTestIncomplete();
    }


    public function testMakeMethodsMock()
    {
        $this->markTestIncomplete();
        /* создали Mock Db */
        $db = $this->createMock(Db::class);

        /* задаём возвращаемое значение метода */
        $db->method('connect')->willReturn(true);

        /* второй вариант подмены */
        $db->method('connect')->will( $this->returnValue(true) );

        $this->assertTrue($this->user->save($db));
    }


    public function testArgumentMock()
    {
        /* создали Mock Db */
        $db = $this->createMock(Db::class);

        /* получаем аргумент переданный в Mock по его индексу */
        $db->method('connect')->will( $this->returnArgument(0) );
    }

    public function testMapMock()
    {
        /* создали Mock Db */
        $db = $this->createMock(Db::class);
        $map = [
            /* если передадим такой набор в метод connect то он должен вернуть true */
            ['host', 'name', '1234', 'db_name', true],
            /* если такой то должен вернуть false */
            ['host', 'fail_name', '0000', 'db_not_available', false],
        ];
        /* передаём Map */
        $db->method('connect')->will( $this->returnValueMap($map) );
    }

    public function testFuncMock()
    {
        /* создали Mock Db */
        $db = $this->createMock(Db::class);
        /* передаём callback */
        $db->method('connect')->will( $this->returnCallback(function(){
            return true;
        }) );
    }

    public function testDiffReturnMock()
    {
        /* создали Mock Db */
        $db = $this->createMock(Db::class);
        /*
         * если несколько раз будем вызывать $db->connect, то вернуться разные значения
         */
        $db->method('connect')->will($this->onConsecutiveCalls(true, false, true));
    }

}
