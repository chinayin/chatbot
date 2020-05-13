<?php

/**
 * This file is part of CommuneChatbot.
 *
 * @link     https://github.com/thirdgerb/chatbot
 * @document https://github.com/thirdgerb/chatbot/blob/master/README.md
 * @contact  <thirdgerb@gmail.com>
 * @license  https://github.com/thirdgerb/chatbot/blob/master/LICENSE
 */

namespace Commune\Ghost\Mind;

use Commune\Ghost\Mind\IRegistries;
use Commune\Blueprint\Ghost\Mind\Registries;
use Commune\Blueprint\Ghost\Mind\Registries\DefRegistry;
use Commune\Blueprint\Ghost\Mind\Mindset;
use Commune\Ghost\Providers\MindCacheExpireOption;
use Commune\Support\Registry\OptRegistry;

/**
 * @author thirdgerb <thirdgerb@gmail.com>
 */
class IMindset implements Mindset
{

    const REGISTRY_IMPL = [
        Registries\ContextReg::class => IRegistries\IContextReg::class,
        Registries\EntityReg::class => IRegistries\IEntityReg::class,
        Registries\SynonymReg::class => IRegistries\ISynonymReg::class,
        Registries\MemoryReg::class => IRegistries\IMemoryReg::class,
        Registries\IntentReg::class => IRegistries\IIntentReg::class,
        Registries\StageReg::class => IRegistries\IStageReg::class,
        Registries\EmotionReg::class => IRegistries\IEmotionReg::class,
    ];

    /**
     * @var OptRegistry
     */
    protected $optRegistry;

    /**
     * @var MindCacheExpireOption
     */
    protected $cacheExpire;

    /*---- cached ----*/

    protected $registries = [];

    /**
     * IMindset constructor.
     * @param OptRegistry $optRegistry
     * @param MindCacheExpireOption $option
     */
    public function __construct(OptRegistry $optRegistry, MindCacheExpireOption $option)
    {
        $this->optRegistry = $optRegistry;
        $this->cacheExpire = $option;
    }

    public function reload(): void
    {
        $this->contextReg()->flushCache();
        $this->intentReg()->flushCache();
        $this->stageReg()->flushCache();
        $this->memoryReg()->flushCache();
        $this->entityReg()->flushCache();
        $this->synonymReg()->flushCache();
        $this->emotionReg()->flushCache();
    }

    public function initContexts(): void
    {
        $contextReg = $this->contextReg();
        foreach($contextReg->each() as $def) {
            $contextReg->registerDef($def);
        }
    }


    /*---- registries ----*/

    protected function getReg(string $type, int $cacheExpire) : DefRegistry
    {
        if (isset($this->registries[$type])) {
            return $this->registries[$type];
        }

        $impl = static::REGISTRY_IMPL[$type];

        return new $impl(
            $this,
            $this->optRegistry,
            $cacheExpire
        );
    }


    public function contextReg(): DefRegistry
    {
        return $this->getReg(
            Registries\ContextReg::class,
            $this->cacheExpire->context
        );
    }

    public function intentReg(): DefRegistry
    {
        return $this->getReg(
            Registries\IntentReg::class,
            $this->cacheExpire->intent
        );
    }

    public function stageReg(): DefRegistry
    {
        return $this->getReg(
            Registries\StageReg::class,
            $this->cacheExpire->stage
        );
    }

    public function memoryReg(): DefRegistry
    {
        return $this->getReg(
            Registries\MemoryReg::class,
            $this->cacheExpire->memory
        );
    }

    public function entityReg(): DefRegistry
    {
        return $this->getReg(
            Registries\EntityReg::class,
            $this->cacheExpire->entity
        );
    }

    public function synonymReg(): DefRegistry
    {
        return $this->getReg(
            Registries\SynonymReg::class,
            $this->cacheExpire->synonym
        );
    }

    public function emotionReg(): DefRegistry
    {
        return $this->getReg(
            Registries\EmotionReg::class,
            $this->cacheExpire->emotion
        );
    }


    public function __destruct()
    {
        $this->registries = [];
        $this->optRegistry = null;
    }
}