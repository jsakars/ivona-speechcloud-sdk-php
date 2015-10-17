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
     * @param Voice $voice
     * @return null|string
     */
    public function listVoices(Voice $voice)
    {
        try {
            $response = $this->getResponse('POST', '/ListVoices', $voice->json());
            if ($response->getStatusCode() === 200) {
                return $response->getBody()->getContents();
            }
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * @param Lexicon $lexicon
     */
    public function putLexicon(Lexicon $lexicon)
    {
        // TODO: implement
    }

    /**
     * @param string $name
     */
    public function getLexicon($name)
    {
        // TODO: implement
    }

    /**
     * @param string $name
     */
    public function deleteLexicon($name)
    {
        // TODO: implement
    }

    public function listLexicons()
    {
        // TODO: implement
    }

    /**
     * @param string $method
     * @param string $uri
     * @param string $body
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    private function getResponse($method, $uri, $body)
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
