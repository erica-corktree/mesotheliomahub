<?php
header('Content-Type: application/json');

require __DIR__ . '/../../../vendor/autoload.php';
require $_SERVER['DOCUMENT_ROOT'] . '/wp/wp-blog-header.php';

use Twilio\Rest\Client;

// Validate the phone number one more time
$_POST = (new GUMP())->sanitize($_POST);

$isValid = GUMP::is_valid($_POST, [
    'phoneNumber'    => 'required|phone_number',
    'callbackNumber' => 'required|phone_number',
]);

if ($isValid) {
    $client = new Client(
        'ACc16cc81d6f8228f7268365b1a0d05862',
        '544a9fafa77e57b69fbb4155b7d7fbf1'
    );

    // Phone numbers
    $phoneNumber           = preg_replace('/[^0-9]/', '', $_POST['phoneNumber']);
    $callbackNumber        = preg_replace('/[^0-9]/', '', $_POST['callbackNumber']);
    $twilioNumber          = get_field('site_twilio_number', 'option');
    $formattedTwilioNumber = preg_replace('/[^0-9]/', '', $twilioNumber);

    // Detect spam with Twilio addon
    $number = $client->lookups
        ->phoneNumbers($phoneNumber)
        ->fetch(['addOns' => 'nomorobo_spamscore']);

    $isSpam = $number->addOns['results']['nomorobo_spamscore']['result']['score'];

    // Blacklist
    $blacklist      = [];
    $blacklistField = get_field('site_phone_number_blacklist', 'option');

    foreach ($blacklistField as $number) {
        $blacklist[] = $number['phone_number'];
    }

    // Silently fail if spam is detected
    if ($isSpam || in_array($_POST['phoneNumber'], $blacklist)) {
        die(json_encode([
            'status'  => 'success',
            'source'  => $_POST['source'],
            'message' => "Thank you! You’ll receive a call from {$twilioNumber} right away.",
        ]));
    }

    $twimlFile    = get_template_directory_uri() . "/forms/callback/connect.php?phone_number={$phoneNumber}&callback_number={$callbackNumber}";
    $noAnswerFile = get_template_directory_uri() . "/forms/callback/no-answer.php";

    try {
        $call = $client->calls->create(
            $phoneNumber, // Call this number
            $formattedTwilioNumber, // From a valid Twilio number
            [
                'url' => $twimlFile,
                'method' => 'GET',
                'statusCallbackMethod' => 'POST',
                'statusCallback'       => $noAnswerFile,
                'statusCallbackEvent'  => ['completed'],
                'timeout'              => 15,
            ]
        );

        die(json_encode([
            'status'  => 'success',
            'source'  => $_POST['source'],
            'message' => "Thank you! You’ll receive a call from {$twilioNumber} right away.",
        ]));
    } catch (Exception $e) {
        $error = $e->getMessage();

        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);

        die(json_encode([
            'status'  => 'error',
            'source'  => $_POST['source'],
            'message' => "We're sorry, there was an error while we tried to connect you: {$error}",
        ]));
    }
} else {
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);

    die(json_encode([
        'status' => 'error',
        'source' => $_POST['source'],
        'message'=> 'Please submit a valid US phone number',
    ]));
}
