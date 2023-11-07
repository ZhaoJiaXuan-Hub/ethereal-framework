<?php

namespace Ethereal\http;

class Request implements RequestInterface
{
    protected $uri;
    protected $method;
    protected $headers;

    public function __construct($uri, $method, $headers)
    {
        $this->uri = $uri;
        $this->method = $method;
        $this->headers = $headers;
    }

    public static function create($uri, $method, $headers)
    {
        return new static($uri, $method, $headers);
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
        return $_GET;
    }

    public function post()
    {
        parse_str(file_get_contents('php://input'), $params);
        return $_POST + $params;
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