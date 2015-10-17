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

class Lexicon extends Base implements \JsonSerializable
{
    const NAME     = 'Name';
    const CONTENTS = 'Contents';

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $contents;

    /**
     * @param string $name
     * @return Lexicon
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $contents
     * @return Lexicon
     */
    public function setContents($contents)
    {
        $this->contents = $contents;

        return $this;
    }

    /**
     * @return string
     */
    public function getContents()
    {
        return $this->contents;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'Lexicon' => [
                self::NAME     => $this->getName(),
                self::CONTENTS => $this->getContents()
            ]
        ];
    }
}
