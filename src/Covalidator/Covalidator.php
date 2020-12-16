<?php

namespace Robin\Covalidator;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

/**
 * Validates coordinates
 */
class Covalidator implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function validateCo($co) {
        return preg_match('/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/', $co);
    }

}