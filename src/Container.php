<?php

namespace Ethereal;

use Ethereal\log\Logger;
use Ethereal\view\ThinkTemplate;
use Ethereal\view\ViewInterface;
use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    // 绑定关系
    public $binding = [];
    // 当前对象实例
    private static $instance;
    // 所有实例存放
    protected $instances = [];

    private function __construct()
    {
        self::$instance = $this; //Container类实例
        $this->register(); //注册绑定
        $this->boot(); // 注册服务
    }

    public function get(string $abstract)
    {
        // 服务已经实例化
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }
        $instance = $this->binding[$abstract]['concrete']($this);
        // 设置为单例
        if ($this->binding[$abstract]['is_singleton']) {
            $this->instances[$abstract] = $instance;
        }
        return $instance;
    }

    public function has(string $id): bool
    {

    }

    public static function getContainer()
    {
        return self::$instance ?? self::$instance = new self();
    }

    public function bind(string $abstract, $concrete, bool $is_singleton = false)
    {
        if (!$concrete instanceof \Closure)
            $concrete = function ($app) use ($concrete) {
                return $app->build($concrete);
            };
        $this->binding[$abstract] = compact('concrete', 'is_singleton');
    }

    protected function getDependencies($parameters)
    {
        // 当前对象所有依赖
        $dependencies = [];
        foreach ($parameters as $parameter)
            if ($parameter->getClass())
                $dependencies[] = $this->get($parameter->getClass()->name);
        return $dependencies;
    }

    public function build($concrete)
    {
        // 反射
        $reflector = new \ReflectionClass($concrete);
        // 获取构造函数
        $constructor = $reflector->getConstructor();
        if (is_null($constructor))
            // 没有依赖直接返回实例
            return $reflector->newInstance();
        // 获取构造函数参数
        $dependencies = $constructor->getParameters();
        // 当前对象所有实例化的依赖
        $instances = $this->getDependencies($dependencies);
        return $reflector->newInstanceArgs($instances);
    }

    protected function register()
    {
        $registers = [
            'response' => \Ethereal\http\Response::class,
            'resquest' => \Ethereal\http\Request::class,
            'route' => \Ethereal\Route::class,
            'config' => \Ethereal\Config::class,
            'database' => \Ethereal\Database::class,
            'pipeline' => \Ethereal\PipeLine::class,
            'config' => \Ethereal\Config::class,
            ViewInterface::class => ThinkTemplate::class,
            'log' => \Ethereal\log\Logger::class,
            'exception' => \App\exceptions\HandleExceptions::class
        ];
        foreach ($registers as $name => $concrete)
            $this->bind($name, $concrete, true);
    }

    protected function boot()
    {
        $container = Container::getContainer();
        $container->get('config')->init();
        $container->get('exception')->init();
        $container->get(ViewInterface::class)->init();
        $config = $container->get('config')->get('database.mysql');
        if(!empty($config['database']) && !empty($config['username']) && !empty($config['password']) && !empty($config['host']))
            $container->get('database')->connect($config);
        $container->get('route')->group([
            'namespace' => 'App\\controller'
        ], function ($router) {
            require_once BASE_PATH . '/route/app.php';
        });
    }
}
