<?php

namespace Robin\Covalidator;
use Anax\Response\ResponseUtility;
use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Testing the Covalidator Service
 */
class CovalidatorTest extends TestCase
{   
    /**
     * Testing the test route
     */
    public function testValidateCo()
    {   
        // Setup
        $covalidator = new Covalidator();
        $res = $covalidator->validateCo("60.85", "26.76");

        $this->assertIsInt($res);
        $this->assertIsNotFloat($res);
    }

}