<?php

namespace Ethereal;

use Ethereal\http\RequestInterface;
use Ethereal\http\Resquest;

class App
{
    public function run():void
    {
        app()->bind(RequestInterface::class,function (){
            return Resquest::create($_SERVER['REQUEST_URI'],$_SERVER['REQUEST_METHOD'],$_SERVER);
        });
        app("route")->dispatch(app(RequestInterface::class));
    }
}