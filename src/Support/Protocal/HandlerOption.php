<?php

/**
 * This file is part of CommuneChatbot.
 *
 * @link     https://github.com/thirdgerb/chatbot
 * @document https://github.com/thirdgerb/chatbot/blob/master/README.md
 * @contact  <thirdgerb@gmail.com>
 * @license  https://github.com/thirdgerb/chatbot/blob/master/LICENSE
 */

namespace Commune\Support\Protocal;

use Commune\Support\Option\AbsOption;


/**
 * 协议 handler 的过滤配置.
 * 挑选协议的原理是: group / protocal / protocalId
 *
 * @author thirdgerb <thirdgerb@gmail.com>
 *
 * @property-read string $group         协议所属的分组
 * @property-read string $protocal      协议的类名
 * @property-read string $handler       Handler 的类名
 * @property-read string[] $filter      协议的过滤, 根据协议 ID 来判断.
 * @property-read array $params         Handler 构造器可以补充的参数, 依赖注入.
 */
class HandlerOption extends AbsOption
{
    public static function stub(): array
    {
        return [
            'group' => '',
            'protocal' => '',
            'handler' => '',
            'filter' => ['*'],
            'params' => [],
        ];
    }

    public static function validate(array $data): ? string /* errorMsg */
    {
        if (empty($data['group'])) {
            return 'group is required';
        }

        if (empty($data['protocal'])) {
            return 'protocal is required';
        }

        return parent::validate($data);
    }

    public static function relations(): array
    {
        return [];
    }


    public function __set_protocal(string $name, string $val)
    {
        $this->_data[$name] = AliasesForProtocal::getAliasOfOrigin($val);
    }

    public function __get_protocal(string $name) : string
    {
        return AliasesForProtocal::getOriginFromAlias($this->_data[$name] ?? '');
    }

    public function __set_handler(string $name, string $val) : void
    {
        $this->_data[$name] = AliasesForProtocal::getAliasOfOrigin($val);
    }


    public function __get_handler(string $name) : string
    {
        return AliasesForProtocal::getOriginFromAlias($this->_data[$name] ?? '');
    }
}