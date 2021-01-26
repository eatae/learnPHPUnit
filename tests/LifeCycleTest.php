<?php

namespace Tests;

use PHPUnit\Framework\TestCase;


class LifeCycleTest extends TestCase
{


    /**
     * Вызывается при создании класса Test
     * как __constructor()
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass(); // TODO: Change the autogenerated stub
    }


    /**
     * Вызывается при удалении класса Test
     * как __destructor()
     */
    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass(); // TODO: Change the autogenerated stub
    }

    /**
     * Вызывается перед выполнением каждого теста
     */
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * ВВызывается после выполнением каждого теста
     */
    protected function tearDown(): void
    {
        parent::tearDown();
    }


    /**
     * Вызывается перед каждым assert
     */
    protected function assertPreConditions(): void
    {
        parent::assertPreConditions(); // TODO: Change the autogenerated stub
    }

    /**
     * Вызывается после каждого assert
     */
    protected function assertPostConditions(): void
    {
        parent::assertPostConditions(); // TODO: Change the autogenerated stub
    }
}
