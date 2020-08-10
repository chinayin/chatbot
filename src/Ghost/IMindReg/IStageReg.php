<?php

/**
 * This file is part of CommuneChatbot.
 *
 * @link     https://github.com/thirdgerb/chatbot
 * @document https://github.com/thirdgerb/chatbot/blob/master/README.md
 * @contact  <thirdgerb@gmail.com>
 * @license  https://github.com/thirdgerb/chatbot/blob/master/LICENSE
 */

namespace Commune\Ghost\IMindReg;

use Commune\Blueprint\Ghost\MindDef\Def;
use Commune\Blueprint\Ghost\MindDef\StageDef;
use Commune\Blueprint\Ghost\MindMeta\StageMeta;
use Commune\Blueprint\Ghost\MindReg\StageReg;
use Commune\Ghost\Support\ContextUtils;

/**
 * @author thirdgerb <thirdgerb@gmail.com>
 */
class IStageReg extends AbsDefRegistry implements StageReg
{
    protected function normalizeDefName(string $name): string
    {
        return ContextUtils::normalizeStageName($name);
    }

    protected function getDefType(): string
    {
        return StageDef::class;
    }

    public function getMetaId(): string
    {
        return StageMeta::class;
    }


    protected function hasRegisteredMeta(string $defName): bool
    {
        // 已经注册过了.
        if (parent::hasRegisteredMeta($defName)) {
            return true;
        }

        // 如果当前 def 名就是 context 的 name
        $contextReg = $this->mindset->contextReg();
        if ($contextReg->hasDef($defName)) {
            $contextDef = $contextReg->getDef($defName);
            $this->registerDef($contextDef->asStageDef());
            return true;
        }

        list($maybeContextName, $stage) = ContextUtils::divideContextNameFromStageName($defName);

        if (empty($maybeContextName)) {
            return false;
        }

        if (!$contextReg->hasDef($maybeContextName)) {
            return false;
        }

        $contextDef = $contextReg->getDef($maybeContextName);
        $stageDef = $contextDef->getPredefinedStage($stage);

        if (isset($stageDef)) {
            $this->registerDef($stageDef);
            return true;
        }

        return false;
    }

    /**
     * @param StageDef $def
     * @param bool $notExists
     * @return bool
     */
    public function registerDef(Def $def, bool $notExists = true): bool
    {
        $success =  parent::registerDef($def, $notExists);
        $force = !$notExists;

        // 强制注册时要主动刷新掉关联的 intent
        if ($force && $success) {
            $intentDef = $def->asIntentDef();
            $this->mindset->intentReg()->registerDef($intentDef, false);
        }
        return $success;
    }
}