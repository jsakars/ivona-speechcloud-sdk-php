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

use Aws\Credentials\Credentials;
use Aws\Signature\SignatureV4;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Werd\Ivona\Models\Input;
use Werd\Ivona\Models\OutputFormat;
use Werd\Ivona\Models\Parameters;
use Werd\Ivona\Models\Voice;
use Werd\Ivona\Models\Lexicon;

class SpeechCloud implements SpeechCloudInterface
{
    const SERVICE_NAME     = 'tts'; // Text-to-Speech
    const SERVICE_PROTOCOL = 'https';
    const SERVICE_DOMAIN   = 'ivonacloud.com';

    /**
     * @var Credentials
     */
    private $credentials;

    /**
     * @var SignatureV4
     */
    private $signature;

    /**
     * @var Client
     */
    private $client;

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->credentials = new Credentials($config['access_key'], $config['secret_key']);
        $this->signature = new SignatureV4(self::SERVICE_NAME, $config['region']);
        $this->client = new Client([
            'base_uri' => self::SERVICE_PROTOCOL . '://' . self::SERVICE_NAME . '.' . $config['region'] . '.' . self::SERVICE_DOMAIN,
            'headers'  => [
                'Content-Type' => 'application/json'
            ]
        ]);
    }

    /**
     * Performs a synthesis of the requested text to the audio stream containing the speech
     *
     * @param Input        $input
     * @param OutputFormat $outputFormat
     * @param Parameters   $parameters
     * @param Voice        $voice
     * @param array        $lexiconNames
     * @return null|string
     */
    public function createSpeech(Input $input, OutputFormat $outputFormat, Parameters $parameters, Voice $voice, $lexiconNames = [])
    {
        try {
            $body = json_encode(array_merge(
                $input->jsonSerialize(),
                $outputFormat->jsonSerialize(),
                $parameters->jsonSerialize(),
                $voice->jsonSerialize(),
                ['LexiconNames' => $lexiconNames]
            ));
            $response = $this->getResponse('POST', '/CreateSpeech', $body);
            if ($response->getStatusCode() === 200) {
                return $response->getBody()->getContents();
            }
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Returns a list of TTS voices available for speech synthesis
     *
     * @param Voice $voice
     * @return null|string
     */
    public function listVoices(Voice $voice)
    {
        try {
            $response = $this->getResponse('POST', '/ListVoices', $voice->toJson());
            if ($response->getStatusCode() === 200) {
                return $response->getBody()->getContents();
            }
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Create a lexicon that can later be used during synthesis
     *
     * @param Lexicon $lexicon
     * @return bool
     */
    public function putLexicon(Lexicon $lexicon)
    {
        try {
            $response = $this->getResponse('POST', '/PutLexicon', $lexicon->toJson());
            if ($response->getStatusCode() === 200) {
                return true;
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Retrieve a lexicon previously stored in the service
     *
     * @param string $name
     * @return null|string
     */
    public function getLexicon($name)
    {
        try {
            $response = $this->getResponse('POST', '/GetLexicon', json_encode([
                Lexicon::NAME => $name
            ]));
            if ($response->getStatusCode() === 200) {
                return $response->getBody()->getContents();
            }
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Delete a lexicon previously stored in the service
     *
     * @param string $name
     * @return bool
     */
    public function deleteLexicon($name)
    {
        try {
            $response = $this->getResponse('POST', '/DeleteLexicon', json_encode([
                Lexicon::NAME => $name
            ]));
            if ($response->getStatusCode() === 200) {
                return true;
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Retrieves a list of user-defined lexicons available for speech synthesis
     *
     * @return null|string
     */
    public function listLexicons()
    {
        try {
            $response = $this->getResponse('POST', '/ListLexicons');
            if ($response->getStatusCode() === 200) {
                return $response->getBody()->getContents();
            }
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * @param string $method
     * @param string $uri
     * @param string $body
     * @return \Psr\Http\Message\ResponseInterface
     */
    private function getResponse($method, $uri, $body = null)
    {
        $request = $this->createRequest($method, $uri, $body);

        return $this->client->send($this->signRequest($request));
    }

    /**
     * @param string $method
     * @param string $uri
     * @param string $body
     * @return Request
     */
    private function createRequest($method, $uri, $body)
    {
        return new Request($method, $this->client->getConfig('base_uri') . $uri, [], $body);
    }

    /**
     * Sign request using AWS Signature Version 4
     *
     * @param Request $request
     * @return Request
     */
    private function signRequest(Request $request)
    {
        return $this->signature->signRequest($request, $this->credentials);
    }
}
