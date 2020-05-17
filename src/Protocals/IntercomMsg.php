<?php

/**
 * This file is part of CommuneChatbot.
 *
 * @link     https://github.com/thirdgerb/chatbot
 * @document https://github.com/thirdgerb/chatbot/blob/master/README.md
 * @contact  <thirdgerb@gmail.com>
 * @license  https://github.com/thirdgerb/chatbot/blob/master/LICENSE
 */

namespace Commune\Protocals;

use Commune\Support\Message\Message;
use Commune\Support\Protocal\Protocal;

/**
 * 机器人内部通信用的消息.
 * @author thirdgerb <thirdgerb@gmail.com>
 */
interface IntercomMsg extends Message, Protocal
{
    /**
     * 传输消息的唯一ID
     * @return string
     */
    public function getMessageId() : string;

    /**
     * 消息体
     * @return HostMsg
     */
    public function getMessage() : HostMsg;

    /**
     * 精确到毫秒
     * @return int
     */
    public function getCreatedAt() : int;

    /**
     * 精确到毫秒
     * @return int
     */
    public function getDeliverAt() : int;
}