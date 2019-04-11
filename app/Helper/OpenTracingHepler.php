<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-04-11
 * Time: 14:53
 */

namespace App\Helper;

use Jaeger\Config as JaegerConfig;


/**
 * 链路监控
 *
 * Class OpenTracingHepler
 * @package App\Helper
 */
class OpenTracingHepler
{
    /**
     * 初始化实例
     * @return OpenTracingHepler|null
     * @throws \Exception
     */
    public static function getInstance()
    {
        static $obj = null;
        if ($obj) {
            return $obj;
        }
        $serverName = env("OPEN_TRACING_SERVER_NAME");
        $agentHostPort = env("OPEN_TRACING_AGENT_HOST_PORT");
        $obj = new OpenTracingHepler();
        $obj->initTracerInstance($serverName, $agentHostPort);
        return $obj;
    }

    /**
     * 初始化
     * @param string $serverName 服务名, 示例: test
     * @param string $agentHostPort 代理主机, 示例: 127.0.0.1:6831
     * @throws \Exception
     */
    public function initTracerInstance($serverName, $agentHostPort)
    {
        $request = app(\Illuminate\Http\Request::class);
        $routeName = $request->path();
        $config = JaegerConfig::getInstance();
        $tracer = $config->initTrace($serverName, $agentHostPort);
        app()->instance('context.tracer', $tracer);
        $globalSpan = $tracer->startSpan($routeName);
        $type = 'http';
        if (app()->runningInConsole()) {
            $type = 'console';
        }
        $globalSpan->setTags(['type' => $type]);
        app()->instance('context.tracer.globalSpan', $globalSpan);
    }

    /**
     * 刷新
     */
    public function flush()
    {
        app('context.tracer.globalSpan')->finish();
        app('context.tracer')->flush();
    }
}