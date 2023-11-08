<?php

namespace Ethereal\http;

class Request implements RequestInterface
{
    protected $uri;
    protected $method;
    protected $headers;
    protected $get;
    protected $post;

    public function __construct($uri, $method, $headers,$get,$post)
    {
        $this->uri = $uri;
        $this->method = $method;
        $this->headers = $headers;
        $this->get = $get;
        $this->post = $post;
    }

    public static function create($uri, $method, $headers,$get,$post)
    {
        return new static($uri, $method, $headers,$get,$post);
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getHeader()
    {
        return $this->headers;
    }

    public function isMethod(string $method)
    {
        $method = $this->getMethod();
        if ($method === $method)
            return true;
        return false;
    }

    public function get()
    {
        return $this->get;
    }

    public function post()
    {
        return $this->post;
    }

    public function all()
    {
        return $this->get() + $this->post();
    }

    public function input(string $name, $default = null)
    {
        $post = $this->post();
        if (isset($post[$name])) {
            return $post[$name];
        }
        $get = $this->get();
        return $get[$name] ?? $default;
    }
}