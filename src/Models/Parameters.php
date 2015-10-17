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

class Parameters extends Base implements \JsonSerializable
{
    const RATE            = 'Rate';
    const VOLUME          = 'Volume';
    const SENTENCE_BREAK  = 'SentenceBreak';
    const PARAGRAPH_BREAK = 'ParagraphBreak';

    /**
     * @var string
     */
    protected $rate = 'medium';

    /**
     * @var string
     */
    protected $volume = 'medium';

    /**
     * @var int
     */
    protected $sentenceBreak = 400;

    /**
     * @var int
     */
    protected $paragraphBreak = 650;

    /**
     * @param string $rate
     * @return Parameters
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * @return string
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * @param string $volume
     * @return Parameters
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;

        return $this;
    }

    /**
     * @return string
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * @param int $sentenceBreak
     * @return Parameters
     */
    public function setSentenceBreak($sentenceBreak)
    {
        $this->sentenceBreak = $sentenceBreak;

        return $this;
    }

    /**
     * @return int
     */
    public function getSentenceBreak()
    {
        return $this->sentenceBreak;
    }

    /**
     * @param int $paragraphBreak
     * @return Parameters
     */
    public function setParagraphBreak($paragraphBreak)
    {
        $this->paragraphBreak = $paragraphBreak;

        return $this;
    }

    /**
     * @return int
     */
    public function getParagraphBreak()
    {
        return $this->paragraphBreak;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'Parameters' => [
                self::RATE            => $this->getRate(),
                self::VOLUME          => $this->getVolume(),
                self::SENTENCE_BREAK  => $this->getSentenceBreak(),
                self::PARAGRAPH_BREAK => $this->getParagraphBreak()
            ]
        ];
    }
}
