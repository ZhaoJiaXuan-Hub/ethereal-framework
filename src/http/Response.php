<?php

namespace Ethereal\http;

use App\exceptions\ErrorMessageException;

class Response
{

    protected $headers = []; // 要发送的请求头
    protected $content = ''; // 要发送的内容
    protected $code = 200; // 发送状态码

    public function sendContent() // 发送内容
    {
        exit($this->content);
    }

    public function sendHeaders() // 发送请求头
    {
        http_response_code($this->code);
        foreach ($this->headers as $key => $header)
            header($key . ': ' . $header);

    }

    public function send() // 发送
    {
        $this->sendHeaders();
        $this->sendContent();
        return $this;
    }

    public function setContent($content) // 设置内容
    {

        if (is_array($content) || is_object($content))
            $content = json_encode($content);

        $this->content = $content;
        return $this;
    }

    public function setHeaders($header)
    {
        $this->headers = $header;
        return $this;
    }


    public function getContent() // 获取内容
    {
        return $this->content;
    }


    public function getStatusCode()     // 获取状态码
    {
        return $this->code;
    }

    public function setCode(int $code) // 设置状态码
    {
        $this->code = $code;
        return $this;
    }

}