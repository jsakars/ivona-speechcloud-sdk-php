<?php

/**
 * This file is part of werd/ivona-speechcloud-sdk-php.
 *
 * (c) Janis Sakars <janis.sakars@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Werd\Ivona\Models;

class Input extends Base implements \JsonSerializable
{
    const DATA = 'Data';
    const TYPE = 'Type';

    /**
     * @var string
     */
    protected $data;

    /**
     * @var string
     */
    protected $type = 'text/plain';

    /**
     * @param string $data
     * @return Input
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param string $type
     * @return Input
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'Input' => [
                self::DATA => $this->getData(),
                self::TYPE => $this->getType()
            ]
        ];
    }
}
