<?php
require __DIR__ . '/../../../vendor/autoload.php';
require $_SERVER['DOCUMENT_ROOT'] . '/wp/wp-blog-header.php';

use Twilio\Rest\Client;

$toPhone    = $_POST["To"];
$callStatus = $_POST["CallStatus"];

$callbackNumber        = get_field('site_callback_number', 'option');
$twilioNumber          = get_field('site_twilio_number', 'option');
$formattedTwilioNumber = preg_replace('/[^0-9]/', '', $twilioNumber);

$client = new Client(
    'ACc16cc81d6f8228f7268365b1a0d05862',
    '544a9fafa77e57b69fbb4155b7d7fbf1'
);

if ($callStatus === 'no-answer') {
    $client->messages->create(
        $toPhone, // Where to send the text message
        [
            'from' => $formattedTwilioNumber,
            'body' => "From RehabSpot.com: Sorry we missed you! Our treatment specialists are available 24/7 at {$callbackNumber}."
        ]
    );

    echo 'SMS sent.';
}
