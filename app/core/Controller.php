<?php

namespace App\Core;

abstract class Controller {
    public function __call($name, $arguments) {
        throw new BadMethodCallException (sprintf(
            'Method "%s" is not Implemented in class "%s" .',
            $name,
            get_class($this)
        ));
    }
}