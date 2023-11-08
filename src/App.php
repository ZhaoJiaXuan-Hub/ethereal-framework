<?php

namespace Ethereal;

use Ethereal\http\RequestInterface;
use Ethereal\http\Request;

class App
{
    public function run(): void
    {
        app()->bind(RequestInterface::class, function () {
            $post = [];
            if($_SERVER['REQUEST_METHOD']==="GET"){
                parse_str(file_get_contents('php://input'), $params);
                $post = (array)$_POST+(array)$params;
            }
            return Request::create($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD'], $_SERVER,$_GET,$post);
        });
        app("route")->dispatch(app(RequestInterface::class))->send();
    }
}