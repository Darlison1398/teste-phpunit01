<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
//use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    //use CreatesApplication;
    //use RefreshDatabase;
}
