<?php

namespace Ethereal;

class Config
{
    protected $config = [];

    public function init()
    {
        foreach (glob(BASE_PATH.'/config/*.php') as $file){
            $key = str_replace('.php','',basename($file));
            if ($key!=='route'){
                $this->config[$key] = require $file;
            }
        }
    }

    // 获取配置
    public function get($key)
    {
        $keys = explode('.',$key);
        $config = $this->config;

        foreach ($keys as $key)
            $config = $config[$key];

        return $config;
    }


    // 重置配置的值
    public function set($key, $val)
    {
        $keys  = explode('.', $key);

        $newconfig = &$this->config;
        foreach($keys as $key)
            $newconfig = &$newconfig[$key]; // 传址

        $newconfig = $val;
    }


}