<?php
require $_SERVER['DOCUMENT_ROOT'] . '/wp/wp-blog-header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/app/themes/mesohub/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Get emails from options page
$emails = get_field('site_guide_email', 'option');

// Sanitize POST data
$_POST = (new GUMP())->sanitize($_POST);
// Switch between form types
$type = $_POST['formType'] ?? '';
// For success/error handling later
$output = [
    'success' => false,
    'error'   => 'There was an error processing your submission.',
    'message' => 'Thank you!',
    'form'    => $type,
];

// Set up SMTP mail
$mail = new PHPMailer(true);

$mail->isSMTP();                              // Set mailer to use SMTP
$mail->Host       = 'smtp.office365.com';     // Specify main and backup SMTP servers
$mail->SMTPAuth   = true;                     // Enable SMTP authentication
$mail->Username   = $emails['from_email'];    // SMTP username
$mail->Password   = $emails['from_password']; // SMTP password
$mail->SMTPSecure = 'tls';                    // Enable TLS encryption, `ssl` also accepted
$mail->Port       = 587;                      // TCP port to connect to
$mail->isHTML(true);                          // Set mailer to output HTML

switch ($type) {
    case 'GuideForm':
        $isValid = GUMP::is_valid($_POST, [
            'first_name'   => 'required|valid_name',
            'last_name'    => 'required|valid_name',
            'phone_number' => 'phone_number',
            'email'        => 'required|valid_email',
            'address'      => 'required|street_address',
            'city'         => 'required',
            'state'        => 'required',
            'zip'          => 'required|numeric',
            'diagnosis'    => 'required',
        ]);

        if ($isValid === true) {
            $mail->addAddress($emails['to_email']);
            $mail->addCC('jan@corktreecreative.com');
            $mail->addCC('laura@corktreecreative.com');
            $mail->addCC('clayloff@gorilaw.com');
            $mail->addCC('sara@gorilaw.com');
            $mail->setFrom($emails['from_email'], 'Mesothelioma Hub');
            $mail->Subject = "[Guide Request]: {$_POST['first_name']} {$_POST['last_name']}";

            $mail->Body .= "Name: {$_POST['first_name']} {$_POST['last_name']}<br />";
            $mail->Body .= "Phone Number: {$_POST['phone_number']}<br />";
            $mail->Body .= "Email: {$_POST['email']}<br /><br />";
            $mail->Body .= "Address:<br />{$_POST['address']}<br />";
            $mail->Body .= "{$_POST['city']}, {$_POST['state']} {$_POST['zip']}<br /><br />";
            $mail->Body .= "Diagnosis:<br />{$_POST['diagnosis']}";

            if (isset($_POST['comment'])) {
                $mail->Body .= "<br /><br />Comment:<br />{$_POST['comment']}";
            }

            $output['success'] = $mail->send();
            $output['error']   = $mail->ErrorInfo;
        }

        break;

    case 'LegalForm':
        $isValid = GUMP::is_valid($_POST, [
            'first_name'   => 'required|valid_name',
            'last_name'    => 'required|valid_name',
            'phone_number' => 'phone_number',
            'email'        => 'required|valid_email',
            'address'      => 'required|street_address',
            'city'         => 'required',
            'state'        => 'required',
            'zip'          => 'required|numeric',
            'diagnosis'    => 'required',
        ]);

        if ($isValid === true) {
            $mail->addAddress($emails['to_email']);
            $mail->addCC('jan@corktreecreative.com');
            $mail->addCC('laura@corktreecreative.com');
            $mail->addCC('clayloff@gorilaw.com');
            $mail->addCC('sara@gorilaw.com');
            $mail->setFrom($emails['from_email'], 'Mesothelioma Hub');
            $mail->Subject = "[Case Eval. Request]: {$_POST['first_name']} {$_POST['last_name']}";

            $mail->Body .= "Name: {$_POST['first_name']} {$_POST['last_name']}<br />";
            $mail->Body .= "Phone Number: {$_POST['phone_number']}<br />";
            $mail->Body .= "Email: {$_POST['email']}<br /><br />";
            $mail->Body .= "Address:<br />{$_POST['address']}<br />";
            $mail->Body .= "{$_POST['city']}, {$_POST['state']} {$_POST['zip']}<br /><br />";
            $mail->Body .= "Diagnosis:<br />{$_POST['diagnosis']}";

            if (isset($_POST['comment'])) {
                $mail->Body .= "<br /><br />Comment:<br />{$_POST['comment']}";
            }

            $output['success'] = $mail->send();
            $output['error']   = $mail->ErrorInfo;
        }

        break;

    case 'ModalGuideForm':
        $isValid = GUMP::is_valid($_POST, [
            'first_name'   => 'required|valid_name',
            'last_name'    => 'required|valid_name',
            'phone_number' => 'phone_number',
            'email'        => 'required|valid_email',
        ]);

        if ($isValid === true) {
            $mail->addAddress($emails['to_email']);
            $mail->addCC('jan@corktreecreative.com');
            $mail->addCC('laura@corktreecreative.com');
            $mail->addCC('clayloff@gorilaw.com');
            $mail->addCC('sara@gorilaw.com');
            $mail->setFrom($emails['from_email'], 'Mesothelioma Hub');
            $mail->Subject = "[Guide Request from Modal]: {$_POST['first_name']} {$_POST['last_name']}";

            $mail->Body .= "Name: {$_POST['first_name']} {$_POST['last_name']}<br />";
            $mail->Body .= "Phone Number: {$_POST['phone_number']}<br />";
            $mail->Body .= "Email: {$_POST['email']}<br />";
            $mail->Body .= "Diagnosis: {$_POST['diagnosis']}";

            $output['success'] = $mail->send();
            $output['error']   = $mail->ErrorInfo;
        }

        break;

    case 'ModalLegalForm':
        $isValid = GUMP::is_valid($_POST, [
            'first_name'   => 'required|valid_name',
            'last_name'    => 'required|valid_name',
            'phone_number' => 'phone_number',
            'email'        => 'required|valid_email',
        ]);

        if ($isValid === true) {
            $mail->addAddress($emails['to_email']);
            $mail->addCC('jan@corktreecreative.com');
            $mail->addCC('laura@corktreecreative.com');
            $mail->addCC('clayloff@gorilaw.com');
            $mail->addCC('sara@gorilaw.com');
            $mail->setFrom($emails['from_email'], 'Mesothelioma Hub');
            $mail->Subject = "[Case Eval. Request from Modal]: {$_POST['first_name']} {$_POST['last_name']}";

            $mail->Body .= "Name: {$_POST['first_name']} {$_POST['last_name']}<br />";
            $mail->Body .= "Phone Number: {$_POST['phone_number']}<br />";
            $mail->Body .= "Email: {$_POST['email']}<br />";
            $mail->Body .= "Diagnosis: {$_POST['diagnosis']}";

            $output['success'] = $mail->send();
            $output['error']   = $mail->ErrorInfo;
        }

        break;

    default:
        $output['error'] = 'No valid form type detected.';
}

if ($_POST) {
    header('Content-Type: application/json');
    die(json_encode($output));
} else {
    die('No POST data submittted.');
}
