<?php

namespace Ethereal\view;

interface ViewInterface
{
    public function init();

    function render($path);
}