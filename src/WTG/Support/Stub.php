<?php

namespace WTG\Support;

class Stub
{
    public function __call($name, $arguments)
    {
        return '';
    }
}