<?php
namespace Eduardor2k\LaravelStaticRoutes\Commands;

use Illuminate\Console\Command;

class StaticRoutesApache2Command extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laradock-static-routes:apache-2';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate .htaccess file in the public folder';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generating .htaccess in public directory');
    }
}