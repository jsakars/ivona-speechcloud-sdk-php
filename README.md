# ivona-speechcloud-sdk-php
[IVONA SpeechCloud](https://www.ivona.com/us/for-business/speech-cloud/) SDK for PHP

[![Latest Stable Version](https://poser.pugx.org/werd/ivona-speechcloud-sdk-php/v/stable)](https://packagist.org/packages/werd/ivona-speechcloud-sdk-php)
[![License](https://poser.pugx.org/werd/ivona-speechcloud-sdk-php/license)](https://packagist.org/packages/werd/ivona-speechcloud-sdk-php)

##Installation
Through [Composer](https://getcomposer.org/):
```
$ composer composer require werd/ivona-speechcloud-sdk-php
```

## Usage
```php
use Werd\Ivona\SpeechCloud;
use Werd\Ivona\Models\Input;
use Werd\Ivona\Models\OutputFormat;
use Werd\Ivona\Models\Parameters;
use Werd\Ivona\Models\Voice;
use Werd\Ivona\Models\Lexicon;

$speechCloud = new SpeechCloud([
    'access_key' => '<your-key>',
    'secret_key' => '<your-secret-key>',
    'region'     => '<region>' // E.g. eu-west-1
]);

// CreateSpeech
$data = $speechCloud->createSpeech(new Input([
    Input::DATA => 'The word or sentence You want to synthesize'
]), new OutputFormat(), new Parameters(), new Voice());
header('Content-Type: audio/mpeg');
echo $data; // Audio stream - use it as You please

$data = $speechCloud->createSpeech(new Input([
    Input::DATA => 'Je Suis Charlie'
]), new OutputFormat(), new Parameters(), new Voice([
    Voice::NAME     => 'Celine',
    Voice::LANGUAGE => 'fr-FR'
]));

// ListVoices
$data = $speechCloud->listVoices(new Voice());

$data = $speechCloud->listVoices(new Voice([
    Voice::LANGUAGE => 'en-US',
    Voice::GENDER   => Voice::GENDER_MALE
])); // Filter American English male voices etc.

// PutLexicon
$data = $speechCloud->putLexicon(new Lexicon([
    Lexicon::NAME => 'Test',
    Lexicon::CONTENTS => '<PLS>'
]));

// GetLexicon
$data = $this->speechCloud->getLexicon('Test');

// DeleteLexicon
$data = $this->speechCloud->deleteLexicon('Test');

// ListLexicons
$data = $this->speechCloud->listLexicons();
```
