<?php

/**
 * This file is part of werd/ivona-speechcloud-sdk-php.
 *
 * (c) Janis Sakars <janis.sakars@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Werd\Ivona;

use Werd\Ivona\Models\Input;
use Werd\Ivona\Models\OutputFormat;
use Werd\Ivona\Models\Parameters;
use Werd\Ivona\Models\Voice;
use Werd\Ivona\Models\Lexicon;

interface SpeechCloudInterface
{
    /**
     * Performs a synthesis of the requested text to the audio stream containing the speech
     *
     * @param Input        $input
     * @param OutputFormat $outputFormat
     * @param Parameters   $parameters
     * @param Voice        $voice
     * @param array        $lexiconNames
     */
    public function createSpeech(Input $input, OutputFormat $outputFormat, Parameters $parameters, Voice $voice, $lexiconNames = []);

    /**
     * Returns a list of TTS voices available for speech synthesis
     *
     * @param Voice $voice
     */
    public function listVoices(Voice $voice);

    /**
     * Create a lexicon that can later be used during synthesis
     *
     * @param Lexicon $lexicon
     */
    public function putLexicon(Lexicon $lexicon);

    /**
     * Retrieve a lexicon previously stored in the service
     *
     * @param string $name
     */
    public function getLexicon($name);

    /**
     * Delete a lexicon previously stored in the service
     *
     * @param string $name
     */
    public function deleteLexicon($name);

    /**
     * Retrieves a list of user-defined lexicons available for speech synthesis
     */
    public function listLexicons();
}
