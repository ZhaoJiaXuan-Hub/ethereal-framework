<?php

namespace Ethereal\http;

interface RequestInterface
{
    /**
     * 初始化
     * @param $uri
     * @param $method
     * @param $headers
     * @param $get
     * @param $post
     */
    public function __construct($uri, $method, $headers,$get,$post);

    /**
     * 创建对象
     * @param $uri
     * @param $method
     * @param $headers
     * @param $get
     * @param $post
     * @return mixed
     */
    public static function create($uri, $method, $headers,$get,$post);

    /**
     * 获取请求url
     * @return mixed
     */
    public function getUri();

    /**
     * 获取请求方法
     * @return mixed
     */
    public function getMethod();

    /**
     * 获取请求头
     * @return mixed
     */
    public function getHeader();

    /**
     * 判断请求方式
     * @param string $method
     * @return mixed
     */
    public function isMethod(string $method);

    /**
     * 获取GET请求参数
     * @return mixed
     */
    public function get();

    /**
     * 获取POST请求参数
     * @return mixed
     */
    public function post();

    /**
     * 获取所有请求参数
     * @return mixed
     */
    public function all();

    /**
     * 获取指定请求参数
     * @param string $name
     * @param $default
     * @return mixed
     */
    public function input(string $name, $default = null);
}