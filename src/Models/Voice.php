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

class Voice extends Base implements \JsonSerializable
{
    const NAME          = 'Name';
    const LANGUAGE      = 'Language';
    const GENDER        = 'Gender';
    const GENDER_MALE   = 'Male';
    const GENDER_FEMALE = 'Female';

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $language;

    /**
     * @var string
     */
    protected $gender;

    /**
     * @param string $name
     * @return Voice
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
     * @param string $language
     * @return Voice
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $gender
     * @return Voice
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'Voice' => [
                self::NAME     => $this->getName(),
                self::LANGUAGE => $this->getLanguage(),
                self::GENDER   => $this->getGender()
            ]
        ];
    }
}
