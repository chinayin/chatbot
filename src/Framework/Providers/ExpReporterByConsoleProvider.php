<?php

/**
 * This file is part of CommuneChatbot.
 *
 * @link     https://github.com/thirdgerb/chatbot
 * @document https://github.com/thirdgerb/chatbot/blob/master/README.md
 * @contact  <thirdgerb@gmail.com>
 * @license  https://github.com/thirdgerb/chatbot/blob/master/LICENSE
 */

namespace Commune\Framework\Providers;

use Commune\Container\ContainerContract;
use Commune\Contracts\Log\ExceptionReporter;
use Commune\Contracts\ServiceProvider;
use Commune\Framework\ExpReporter\ConsoleExceptionReporter;

/**
 * 简单的异常报告模块. 用控制台日志来替代报告.
 *
 * @author thirdgerb <thirdgerb@gmail.com>
 */
class ExpReporterByConsoleProvider extends ServiceProvider
{
    public static function stub(): array
    {
        return [];
    }

    public function getDefaultScope(): string
    {
        return self::SCOPE_PROC;
    }


    public function boot(ContainerContract $app): void
    {
    }

    public function register(ContainerContract $app): void
    {
        $app->singleton(
            ExceptionReporter::class,
            ConsoleExceptionReporter::class
        );
    }


}