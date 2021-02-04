<?php
namespace Eduardor2k\LaravelStaticRoutes\Commands;

use Illuminate\Console\Command;
use Illuminate\View\Factory as ViewFactory;
use Illuminate\Routing\Router;
use Illuminate\Filesystem\Filesystem;

class StaticRoutesApache2Command extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel-static-routes:apache-2 {filename?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate .htaccess file in the public folder';

    private ViewFactory $view;

    private Router $router;

    private Filesystem $filesystem;

    public function __construct(ViewFactory $view, Router $router, Filesystem $filesystem)
    {
        parent::__construct();

        $this->view = $view;
        $this->router = $router;
        $this->filesystem = $filesystem;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filePath = public_path(($this->argument('filename') ?? '.htaccess'));
        $content = $this->view->make('laravel-static-routes::apache2.htaccess', ['routes' => $this->getRoutes()]);

        if($this->filesystem->put($filePath, $content)){
            $this->info('.htaccess generated correctly in public directory');
            return;
        }
        $this->error(sprintf('Unable to save .htaccess file at %s',$filePath));
    }

    protected function getRoutes()
    {
        $data = [];
        /**
         * @var \Illuminate\Routing\Route $route
         */
        foreach($this->router->getRoutes() as $route){
            $data[$this->replace($route->uri())][] = $route->getName();
        }

        return $data;
    }

    /**
     * Replace laravel parameters with regular expressión for apache
     *
     * @param string $uri
     * @return string
     */
    protected function replace($uri)
    {
        $regex = '/\{[a-z:A-Z0-9_\?]+\}/';
        $replacement = '[0-9a-zA-Z]+';
        return preg_replace($regex, $replacement, $uri);
    }
}