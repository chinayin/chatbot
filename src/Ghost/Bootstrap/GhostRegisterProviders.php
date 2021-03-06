<?php

/**
 * This file is part of CommuneChatbot.
 *
 * @link     https://github.com/thirdgerb/chatbot
 * @document https://github.com/thirdgerb/chatbot/blob/master/README.md
 * @contact  <thirdgerb@gmail.com>
 * @license  https://github.com/thirdgerb/chatbot/blob/master/LICENSE
 */

namespace Commune\Ghost\Bootstrap;

use Commune\Blueprint\Framework\App;
use Commune\Blueprint\Ghost;
use Commune\Framework\Bootstrap\RegisterProviders;


/**
 * @author thirdgerb <thirdgerb@gmail.com>
 */
class GhostRegisterProviders extends RegisterProviders
{
    /**
     * @param Ghost $app
     * @return array
     */
    public function getProviderConfigs(App $app): array
    {
        return $app->getConfig()->providers;
    }


}