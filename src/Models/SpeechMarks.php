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

class SpeechMarks extends Base implements \JsonSerializable
{
    const SENTENCE = 'Sentence';
    const SSML     = 'Ssml';
    const VISEME   = 'Viseme';
    const WORD     = 'Word';

    /**
     * @var bool
     */
    protected $sentence = false;

    /**
     * @var bool
     */
    protected $ssml = false;

    /**
     * @var bool
     */
    protected $viseme = false;

    /**
     * @var bool
     */
    protected $word = false;

    /**
     * @param boolean $sentence
     * @return SpeechMarks
     */
    public function setSentence($sentence)
    {
        $this->sentence = $sentence;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isSentence()
    {
        return $this->sentence;
    }

    /**
     * @param boolean $ssml
     * @return SpeechMarks
     */
    public function setSsml($ssml)
    {
        $this->ssml = $ssml;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isSsml()
    {
        return $this->ssml;
    }

    /**
     * @param boolean $viseme
     * @return SpeechMarks
     */
    public function setViseme($viseme)
    {
        $this->viseme = $viseme;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isViseme()
    {
        return $this->viseme;
    }

    /**
     * @param boolean $word
     * @return SpeechMarks
     */
    public function setWord($word)
    {
        $this->word = $word;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isWord()
    {
        return $this->word;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'SpeechMarks' => [
                self::SENTENCE => $this->isSentence(),
                self::SSML     => $this->isSsml(),
                self::VISEME   => $this->isViseme(),
                self::WORD     => $this->isWord()
            ]
        ];
    }
}
