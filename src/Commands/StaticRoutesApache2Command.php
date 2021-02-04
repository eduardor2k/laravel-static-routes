<?php
namespace Eduardor2k\LaravelStaticRoutes\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\View\Factory as ViewFactory;

class StaticRoutesApache2Command extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel-static-routes:apache-2';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate .htaccess file in the public folder';

    public function __construct(ViewFactory $view)
    {
        parent::__construct();

        $this->view = $view;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $content = $this->view->make('laravel-static-routes.apache2.htaccess', ['routes' => $this->build()]);

        $filePath = public_path().'/.htaccess';
        if(File::put($filePath, $content)){
            $this->info('.htaccess generated correctly in public directory');
            return;
        }
        $this->error(sprintf('Unable to save .htaccess file at %s',$filePath));
    }

    protected function build()
    {
        $data = [];
        /**
         * @var \Illuminate\Routing\Route $route
         */
        foreach(app()->routes->getRoutes() as $route){
            $data[$this->replace($route->uri())][] = $route->getName();
        }

        return $data;
    }

    protected function replace($uri)
    {
        $regex = '/\{[a-z:A-Z0-9_\?]+\}/';
        $replacement = '[0-9a-zA-Z]+';
        return preg_replace($regex, $replacement, $uri);
    }
}