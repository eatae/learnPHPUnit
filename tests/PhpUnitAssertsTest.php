<?php


namespace Tests;

use App\Models\User;
use PHPUnit\Framework\TestCase;


class PhpUnitAssertsTest extends TestCase
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

    public function testMethods()
    {

        // $this->assertArrayHasKey('some_key', ['some_key' => 35]);

        // $this->assertClassHasAttribute('name', User::class);

        // $this->assertClassHasStaticAttribute('name', User::class);

        // $this->assertContains('foo', ['foo']);

        // $this->assertContainsOnly('string', ['foo', 'bar']);

        // $this->assertContainsOnly('string', ['foo', 'bar']);

        // $this->assertContainsOnlyInstancesOf(User::class, [$this->user]);

        // $this->assertCount(2, ['1', '2']);

        // $this->assertDirectoryExists(__DIR__ . "/../tests");

        // $this->assertDirectoryIsReadable(__DIR__);

        // $this->assertDirectoryIsWritable(__DIR__);

        // $this->assertEmpty('not_empty');

        // $this->assertSame('foo', 'foo');

        // $this->assertFileNotEquals(__DIR__.'/ExceptionTest.php', __DIR__.'/MockeryTest.php');

        // $this->assertGreaterThan(1, 2);

        // $this->assertGreaterThanOrEqual(2, 2);

        // $this->assertInfinite(INF);

        // $this->assertInfinite(INF);

        // $this->assertIsArray([]);

        // $this->assertIsIterable($this->user);

        // $this->assertLessThan(3, 2);

        // $this->assertNan('foo');

        // $this->assertStringMatchesFormat('%f', 'Some string');

        // $this->assertStringStartsWith('Start', 'Start some string.');

        $this->assertStringEndsWith('end.', 'Some string end.');

    }



}
