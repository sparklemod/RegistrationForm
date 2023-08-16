<?php

namespace Test;

use FirstTest;
use PHPUnit\Framework\TestCase;

class Test extends TestCase
{
    public function testString()
    {
        $a = 'string1';
        $this->assertEquals('string1',$a);
    }
}
