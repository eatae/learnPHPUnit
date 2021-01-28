<?php

namespace Tests;

use App\Models\Db;
use App\Models\User;
use phpDocumentor\Reflection\Types\This;
use PHPUnit\Framework\Error\Error;
use PHPUnit\Framework\TestCase;


class MockTwoTest extends TestCase
{
    /**
     * @var User
     */
    private $user;

    protected function setUp(): void {
        $this->user = new User('StdOutTest', 'test@email.com', '1234', 23);
    }

    protected function tearDown(): void {
        parent::tearDown();
    }


    public function testMockBuilder()
    {
        $db = $this->getMockBuilder(Db::class)->
            disableOriginalConstructor()->
            getMock();
    }



}
