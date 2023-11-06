<?php
namespace Ethereal\log\driver;

use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use Psr\Log\AbstractLogger;
use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;

class StackLogger extends AbstractLogger
{

    protected $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function interpolate($message, array $context = array())
    {

        // 构建一个花括号包含的键名的替换数组
        $replace = array();
        foreach ($context as $key => $val) {
            // 检查该值是否可以转换为字符串
            if (!is_array($val) && (!is_object($val) || method_exists($val, '__toString'))) {
                $replace['{' . $key . '}'] = $val;
            }
        }

        // 替换记录信息中的占位符，最后返回修改后的记录信息。
        return strtr($message, $replace);
    }


    /**
     * @inheritDoc
     */
    public function log($level, string|\Stringable $message, array $context = []): void
    {
        if (is_array($message))
            $message = var_export($message, true) . var_export($context, true); // 设置true 不输出
        else if (is_string($message)) // 内容是字符串 并且 $context是数组 替换占位符
            $message = $this->interpolate($message, $context);

        $message = sprintf($this->config['format'], date('y-m-d h:m:s'), $level, $message); // 根据配置文件格式化
        // 目录不存在自动创建
        if (!is_dir($this->config['path'])) {
            mkdir($this->config['path'], 0777, true);
        }
        error_log($message . PHP_EOL, 3, $this->config['path'] . '/php_frame.log');
    }
}