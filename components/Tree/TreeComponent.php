<?php

/**
 * This file is part of CommuneChatbot.
 *
 * @link     https://github.com/thirdgerb/chatbot
 * @document https://github.com/thirdgerb/chatbot/blob/master/README.md
 * @contact  <thirdgerb@gmail.com>
 * @license  https://github.com/thirdgerb/chatbot/blob/master/LICENSE
 */

namespace Commune\Components\Tree;

use Commune\Blueprint\Framework\App;
use Commune\Framework\Component\AComponentOption;


/**
 * 树状结构的多轮对话组件.
 *
 * 用一个树来定义多轮对话的基本结构.
 * 多轮对话的本质是对该树进行寻路或遍历.
 *
 * 然后用辅助的配置和 event handler 来描述其逻辑.
 * 进一步实现自动录制对话的功能. 不过这一点并非必须.
 *
 * @author thirdgerb <thirdgerb@gmail.com>
 */
class TreeComponent extends AComponentOption
{
    public static function stub(): array
    {
        // TODO: Implement stub() method.
    }

    public static function relations(): array
    {
        // TODO: Implement relations() method.
    }

    public function bootstrap(App $app): void
    {
        // TODO: Implement bootstrap() method.
    }


}