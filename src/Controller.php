<?php

namespace Ethereal;

class Controller
{
    protected $middleware = [];

    public function getMiddleware()
    {
        return $this->middleware;
    }

    public function callAction($method, $parameters)
    {
        return call_user_func_array([$this, $method], $parameters);
    }
}