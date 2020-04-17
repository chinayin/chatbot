<?php

/**
 * This file is part of CommuneChatbot.
 *
 * @link     https://github.com/thirdgerb/chatbot
 * @document https://github.com/thirdgerb/chatbot/blob/master/README.md
 * @contact  <thirdgerb@gmail.com>
 * @license  https://github.com/thirdgerb/chatbot/blob/master/LICENSE
 */

namespace Commune\Framework\Exceptions;


/**
 * Callable 对象异常
 *
 * @author thirdgerb <thirdgerb@gmail.com>
 */
class InvalidCallableReturnException extends AppLogicException
{

    public function __construct(string $method, string $expect, string $given)
    {
        $message = "invalid callable return for $method, expect $expect, $given given";
        parent::__construct($message);
    }

}