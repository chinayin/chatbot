<?php

/**
 * This file is part of CommuneChatbot.
 *
 * @link     https://github.com/thirdgerb/chatbot
 * @document https://github.com/thirdgerb/chatbot/blob/master/README.md
 * @contact  <thirdgerb@gmail.com>
 * @license  https://github.com/thirdgerb/chatbot/blob/master/LICENSE
 */

namespace Commune\Shell\Prototype\Events;

use Commune\Shell\Blueprint\Event\ShellEvent;

/**
 * @author thirdgerb <thirdgerb@gmail.com>
 */
class StartShlSession implements ShellEvent
{
    public function getId(): string
    {
        return static::class ;
    }
}