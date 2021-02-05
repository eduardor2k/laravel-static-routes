<?php

namespace Tests;

use Eduardor2k\LaravelStaticRoutes\Commands\StaticRoutesApache2Command;

class StaticRoutesApache2CommandTest extends TestBase
{
    public function routePaths()
    {
        return [
            ['api/{locale}/modem/{modem}/command/{command}/parameter','api/[0-9a-zA-Z]+/modem/[0-9a-zA-Z]+/command/[0-9a-zA-Z]+/parameter']
        ];
    }

    /**
     * @dataProvider routePaths
     */
    public function testBinaryCommand($path, $expectedPath)
    {
        $command = new StaticRoutesApache2Command(null, null, null);
        $this->assertEquals($expectedPath, $this->callMethod($command,'replace', $path));
    }
}