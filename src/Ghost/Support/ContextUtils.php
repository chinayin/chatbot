<?php

/**
 * This file is part of CommuneChatbot.
 *
 * @link     https://github.com/thirdgerb/chatbot
 * @document https://github.com/thirdgerb/chatbot/blob/master/README.md
 * @contact  <thirdgerb@gmail.com>
 * @license  https://github.com/thirdgerb/chatbot/blob/master/LICENSE
 */

namespace Commune\Ghost\Support;

use Commune\Blueprint\Ghost\Ucl;
use Commune\Support\Utils\StringUtils;

/**
 * @author thirdgerb <thirdgerb@gmail.com>
 */
class ContextUtils
{

    public static function normalizeContextName(string $contextName) : string
    {
        $contextName = StringUtils::namespaceSlashToDot($contextName);
        return strtolower($contextName);
    }

    public static function normalizeStageName(string $stageName) : string
    {
        return strtolower($stageName);
    }

    public static function parseContextClassToName(string $str) : string
    {
        $str = StringUtils::namespaceSlashToDot($str);
        return strtolower($str);
    }

    public static function isValidContextName(string $str) : bool
    {
        $pattern = '/^[a-z][a-z0-9]*(\.[a-z][a-z0-9]+)*$/';
        return (bool) preg_match($pattern, $str);
    }

    public static function isValidMemoryName(string $str) : bool
    {
        return self::isValidContextName($str);
    }

    public static function normalizeMemoryName(string $str) : string
    {
        return strtolower(StringUtils::namespaceSlashToDot($str));
    }

    public static function isValidStageFullName(string $str) : bool
    {
        return self::isValidIntentName($str);
    }

    public static function isValidStageName(string $name) : bool
    {
        // 允许为空.
        if ($name === '') {
            return true;
        }
        $pattern = '/^[a-z][a-z_0-9]+$/';
        return (bool) preg_match($pattern, $name);
    }

    public static function isValidIntentName(string $str) : bool
    {
        $pattern = '/^[a-z][a-z0-9]*(\.[a-z][a-z0-9]+)*(\.[a-z][a-z_0-9]+){0,1}$/';
        return (bool) preg_match($pattern, $str);
    }

    public static function isValidEntityName(string $str) : bool
    {
        return self::isValidContextName($str);
    }

    public static function isCallableClass($value) : bool
    {
        return is_string($value)
            && class_exists($value)
            && method_exists($value, '__invoke');
    }

}