<?php

namespace Ethereal;

use Throwable;
use App\exceptions\ErrorMessageException;

class HandleExceptions
{
    // 忽略记录的异常
    protected $ignore = [];

    public function init()
    {
        // 所有异常托管到handleException方法
        set_exception_handler([$this, 'handleException']);
        // 所有错误托管到handleErorr
        set_error_handler([$this, 'handleError']);
    }

    public function handleException(Throwable $e)
    {
        if (method_exists($e, 'render')) // 如果自定义的异常类存在render()方法
            app('response')->setContent(
                $e->render()
            )->setCode($e->getCode())->send();


        if (!$this->isIgnore($e)) { // 不忽略 记录异常到日志去
            app('response')->setContent(['code' => 500, 'message' => $e->getMessage(), 'data' => ['file' => $e->getFile(), 'line' => $e->getLine()]])->setCode(500)->send();
            app('log')->debug(
                $e->getMessage() . ' at ' . $e->getFile() . ':' . $e->getLine()
            );
        }
    }

    public function handleError($errno, $error_message, $errfile, $errline)
    {
        app('response')->setContent(['code' => 500, 'message' => $error_message, 'data' => ['file' => $errfile, 'line' => $errline]])->setCode(500)->send();

        // 记录到日志
        app('log')->error(
            $error_message . ' at ' . $errfile . ':' . $errline
        );
    }

    protected function isIgnore(Throwable $e)
    {
        foreach ($this->ignore as $item)
            if ($item == get_class($e))
                return true;
        return false;
    }
}