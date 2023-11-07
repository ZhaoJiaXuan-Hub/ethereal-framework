<?php

namespace Ethereal\view;

use Ethereal\Container;

class ThinkTemplate implements ViewInterface
{
    protected $templatel;

    public function init()
    {
        $config = Container::getContainer()->get('config')->get('view');
        $this->templatel = new Template([
            'view_path' => $config['view_path'],
            'cache_path' => $config['cache_path']
        ]);
    }

    public function render($path, array $params = [])
    {
        $this->templatel->assign($params);
        $path = str_replace('.', '/', $path);
        return $this->templatel->fetch($path);
    }
}