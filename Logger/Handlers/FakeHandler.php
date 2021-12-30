<?php

namespace Logger\Handlers;

class FakeHandler extends BaseHandler  
{
    public function __construct()
    {
    }

    public function log(string $level, string $message): void
    {
    }
}