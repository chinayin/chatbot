<?php

/**
 * This file is part of CommuneChatbot.
 *
 * @link     https://github.com/thirdgerb/chatbot
 * @document https://github.com/thirdgerb/chatbot/blob/master/README.md
 * @contact  <thirdgerb@gmail.com>
 * @license  https://github.com/thirdgerb/chatbot/blob/master/LICENSE
 */

namespace Commune\Blueprint\Ghost;

use Commune\Blueprint\Ghost\Cloner\ClonerInstanceStub;
use Commune\Blueprint\Ghost\Context\Dependable;
use Commune\Support\Arr\ArrayAndJsonAble;
use Commune\Blueprint\Ghost\MindDef\StageDef;
use Commune\Blueprint\Ghost\MindDef\IntentDef;
use Commune\Blueprint\Ghost\MindDef\ContextDef;
use Commune\Blueprint\Ghost\Exceptions\DefNotDefinedException;
use Commune\Blueprint\Ghost\Exceptions\InvalidQueryException;
use Commune\Blueprint\Exceptions\Logic\InvalidArgumentException;


/**
 * 把核心方法从 Ucl 中拆出来, 当成独立文档.
 *
 *
 * @author thirdgerb <thirdgerb@gmail.com>
 *
 * @property-read string $contextName
 * @property-read string $stageName
 * @property-read string[] $query
 */
interface UclInterface extends
    ArrayAndJsonAble,
    Dependable,
    ClonerInstanceStub
{

    /*------ create ------*/

    /**
     * @param string $contextName
     * @param array $query
     * @param string $stageName
     * @return Ucl
     */
    public static function make(
        string $contextName,
        array $query = [],
        string $stageName = ''
    ) : Ucl;


    /**
     * @param string|Ucl $string
     * @return Ucl
     * @throws InvalidArgumentException
     */
    public static function decode($string) : Ucl;

    /**
     * @return string
     */
    public function encode() : string;

    /**
     * @param Cloner $cloner
     * @param string $contextName
     * @param array|null $query
     * @param string $stageName
     * @return Ucl
     * @throws InvalidQueryException
     * @throws DefNotDefinedException
     */
    public static function newInstance(
        Cloner $cloner,
        string $contextName,
        array $query = null,
        string $stageName = ''
    )  : Ucl;


    /**
     * @param Ucl|string $ucl
     * @return string
     */
    public static function parseIntentName($ucl) : ? string;

    /*------ property ------*/

    /**
     * @return string
     */
    public function getContextId() : string;


    /**
     * @param string|null $stage
     * @return string
     */
    public function getStageFullname(string $stage = null) : string;

    /*------ compare ------*/

    /**
     * @param Ucl $ucl
     * @return bool
     */
    public function atSameContext(Ucl $ucl) : bool;

    /**
     * @param Ucl $ucl
     * @return bool
     */
    public function isSameContext(Ucl $ucl) : bool;

    /**
     * @param string $ucl
     * @return bool
     */
    public function equals($ucl) : bool;

    /*------ cloner instance ------*/

    /**
     * @return bool
     */
    public function isInstanced() : bool;

    /**
     * @param Cloner $cloner
     * @return Ucl
     * @throws InvalidQueryException
     * @throws DefNotDefinedException
     */
    public function toInstance(Cloner $cloner) : Ucl;


    /*------ redirect ------*/

    /**
     * @param string $stageName
     * @return Ucl
     * @throws InvalidArgumentException
     */
    public function goStage(string $stageName) : Ucl;

    /**
     * @param string $fullname
     * @return Ucl
     */
    public function goStageByFullname(string $fullname) : Ucl;

    /*------ validate ------*/

    /**
     * 规则是否正确.
     * @return bool
     */
    public function isValidPattern() : bool;

    /**
     * @param Cloner $cloner
     * @return bool
     */
    public function isValid(Cloner $cloner) : bool;

    /*------ mindset ------*/

    /**
     * @param Cloner $cloner
     * @return bool
     */
    public function stageExists(Cloner $cloner) : bool;

    /**
     * @param Cloner $cloner
     * @return StageDef
     * @throws DefNotDefinedException
     */
    public function findStageDef(Cloner $cloner) : StageDef;

    /**
     * @param Cloner $cloner
     * @return ContextDef
     * @throws DefNotDefinedException
     */
    public function findContextDef(Cloner $cloner) : ContextDef;

    /**
     * @param Cloner $cloner
     * @return IntentDef|null
     */
    public function findIntentDef(Cloner $cloner) : ? IntentDef;

    /**
     * @param Cloner $cloner
     * @return Context
     * @throws DefNotDefinedException
     * @throws InvalidArgumentException
     */
    public function findContext(Cloner $cloner) : Context;

    /*------ string ------*/

    /**
     * @return string
     */
    public function __toString() : string;
}
