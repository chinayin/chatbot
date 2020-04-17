<?php

/**
 * This file is part of CommuneChatbot.
 *
 * @link     https://github.com/thirdgerb/chatbot
 * @document https://github.com/thirdgerb/chatbot/blob/master/README.md
 * @contact  <thirdgerb@gmail.com>
 * @license  https://github.com/thirdgerb/chatbot/blob/master/LICENSE
 */

namespace Commune\Ghost\Blueprint\Routing;

use Commune\Ghost\Blueprint\Context\Context;
use Commune\Ghost\Blueprint\Operator\Operator;


/**
 * 重定向到其它的 Context
 *
 * @author thirdgerb <thirdgerb@gmail.com>
 */
interface Redirect
{
    /**
     * 将当前的 Thread 睡眠掉.
     * 用一个 Context, 或者唤醒一个 Thread (优先 blocking )来处理后续流程.
     * 如果当前 Thread 就是唯一的 Thread, 则会触发 Quit
     *
     * @param Context|null $to
     * @param string|null $wakeThreadId         允许主动唤醒一个 Thread, 前提是知道它的 Id
     * @param int $gcTurn                       当前 Thread 不是 sleep, 而是进入 GC 周期, 除非被唤醒, 否则消失.
     * @return Operator
     */
    public function sleepTo(Context $to = null, string $wakeThreadId = null, int $gcTurn = 0) : Operator;

    /**
     * 依赖一个 Context, 该 Context 回调时会触发 onReject/onCancel/onFulfill 等状态.
     * @param Context $depending
     * @return Operator
     */
    public function dependOn(Context $depending) : Operator;


    /**
     * 将当前 Thread 暂时撤出, 等待服务回调.
     *
     * @param string $shellName
     * @param string $shellId
     * @param Context $asyncContext
     * @param Context|null $toContext
     * @param string|null $wakeThreadId
     * @param int|null $expire
     * @return Operator
     */
    public function yieldTo(
        string $shellName,
        string $shellId,
        Context $asyncContext,
        Context $toContext = null,
        string $wakeThreadId = null,
        int $expire = null
    ) : Operator;

    /**
     * 用一个 Context 替换掉当前的 Context. 应该要保证回退的时候一致.
     * @param Context $context
     * @return Operator
     */
    public function replaceNode(Context $context) : Operator;

    /**
     * 替换掉当前的 Thread, 进入一个新的 Thread
     * @param Context $context
     * @return Operator
     */
    public function replaceThread(Context $context) : Operator;

    /**
     * 用一个 Context 替换掉整个 Process 的所有内容, 进入一个新的 Context
     * @param Context $context
     * @return Operator
     */
    public function replaceProcess(Context $context) : Operator;

    /**
     * 回到当前 Process 的起点.
     * @return Operator
     */
    public function home() : Operator;
}