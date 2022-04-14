<?php
header('Content-type: application/xml');

require __DIR__ . '/../../../vendor/autoload.php';
require $_SERVER['DOCUMENT_ROOT'] . '/wp/wp-blog-header.php';

use Twilio\Twiml;

$phoneNumber    = isset($_GET['phone_number']) ? $_GET['phone_number'] : '';
$callbackNumber = isset($_GET['callback_number'])
                  ? $_GET['callback_number']
                  : preg_replace(
                        '/[^0-9]/',
                        '',
                        get_field('site_callback_number', 'option')
                    );

// Generate TwiML to make the call
$twiml = new Twiml();

$twiml->say(
    'Thank you for contacting Rehab Spot. Please hold while we connect you with a treatment specialist.',
    [
        'voice'    => 'woman',
        'language' => 'en'
    ]
);

$twiml->dial($callbackNumber, [
    'callerId' => $phoneNumber,
    'timeout'  => '90',
]);

print $twiml;
