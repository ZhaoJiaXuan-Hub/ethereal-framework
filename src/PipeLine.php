<?php

namespace Ethereal;

class PipeLine
{
    // 所有要执行的类
    protected $classes = [];
    // 类的方法名称
    protected $handleMethod = 'handle';

    public function create()
    {
        return clone $this;
    }

    public function setHandleMethod($method)
    {
        $this->handleMethod = $method;
        return $this;
    }

    public function setClass($class)
    {
        $this->classes = $class;
        return $this;
    }

    /**
     * 传递闭包运行管道
     * @param \Closure $initial
     * @return \Closure
     */
    public function run(\Closure $initial)
    {
        return array_reduce( array_reverse($this->classes),function($res, $currClass){
            return function ($request) use ($res,$currClass) {
                return (new $currClass)->{$this->handleMethod}($request,$res);
            };
        },$initial);
    }

}