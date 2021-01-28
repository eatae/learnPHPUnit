<?php

namespace Tests;

use PHPUnit\Framework\TestCase;


class OrgStatusesTest extends TestCase
{

    /**
     * пустой тест вернёт RISK
     */
    public function testRiskStatus() {}

    /**
     * указываем RISK
     */
    public function testRiskStatus2()
    {
        $this->markAsRisky();
    }

    /**
     * указываем Fail
     */
    public function testFail()
    {
        $this->fail();
    }

    /**
     * указываем Incomplete
     */
    public function testIncomplete()
    {
        $this->markTestIncomplete();
    }

    /**
     * указываем Skip
     *
     *
     */
    public function testSkip()
    {
        // пропусти данный тест если...
        if (true) {
            $this->markTestSkipped();
        }
    }

}
