<?php

use Tests\TestCase;

class ApiIndexTest extends TestCase
{
    final public function testIndex(): void
    {
        $request = $this->createRequest('GET', '/');
        $res = $this->app->handle($request);

        self::assertEquals('Hello world!', (string)$res->getBody());
    }
}
