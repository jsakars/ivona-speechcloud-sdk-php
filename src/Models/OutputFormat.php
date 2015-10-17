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

class OutputFormat extends Base implements \JsonSerializable
{
    const CODEC        = 'Codec';
    const SAMPLE_RATE  = 'SampleRate';
    const SPEECH_MARKS = 'SpeechMarks';

    /**
     * @var string
     */
    protected $codec = 'MP3';

    /**
     * @var int
     */
    protected $sampleRate = 22050;

    /**
     * @var SpeechMarks
     */
    protected $speechMarks;

    /**
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        $this->speechMarks = new SpeechMarks();

        parent::__construct($params);
    }

    /**
     * @param string $codec
     * @return OutputFormat
     */
    public function setCodec($codec)
    {
        $this->codec = $codec;

        return $this;
    }

    /**
     * @return string
     */
    public function getCodec()
    {
        return $this->codec;
    }

    /**
     * @param int $sampleRate
     * @return OutputFormat
     */
    public function setSampleRate($sampleRate)
    {
        $this->sampleRate = $sampleRate;

        return $this;
    }

    /**
     * @return int
     */
    public function getSampleRate()
    {
        return $this->sampleRate;
    }

    /**
     * @param SpeechMarks $speechMarks
     * @return OutputFormat
     */
    public function setSpeechMarks(SpeechMarks $speechMarks)
    {
        $this->speechMarks = $speechMarks;

        return $this;
    }

    /**
     * @return SpeechMarks
     */
    public function getSpeechMarks()
    {
        return $this->speechMarks;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'OutputFormat' => array_merge([
                self::CODEC       => $this->getCodec(),
                self::SAMPLE_RATE => $this->getSampleRate()
            ], $this->getSpeechMarks()->jsonSerialize())
        ];
    }
}
