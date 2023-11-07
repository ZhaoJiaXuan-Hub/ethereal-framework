<?php

namespace Ethereal\log;

use Ethereal\log\driver\StackLogger;

class Logger
{

    protected $channels = []; // 所有的实例化的通道  就是多例而已

    protected $config;

    public function __construct()
    {
        $this->config = app('config')->get('log');
    }

    public function channel($name = null)
    {

        if (!$name) // 没选择名字
            $name = $this->config['default'];

        if (isset($this->channels[$name]))
            return $this->channels[$name];

        $config = app('config')->get('log.channels.' . $name);

        return $this->channels['name'] = $this->{'create' . ucfirst($config['driver'])}($config);
    }


    // 放在同一个文件
    public function createStack($config)
    {
        return new StackLogger($config);
    }

    public function __call($method, $parameters)
    {
        return $this->channel()->$method(...$parameters);
    }

}