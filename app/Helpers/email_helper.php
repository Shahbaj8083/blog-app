<?php

if (!function_exists('sendEmail')) {
    function sendEmail($to, $subject, $message)
    {
        $email = \Config\Services::email();
        $email->setFrom(env('email.fromEmail'), env('email.fromName'));
        $email->setTo($to);
        $email->setSubject($subject);
        $email->setMessage($message);
        
        if (!$email->send()) {
            // Log any errors that occur during sending
            log_message('error', $email->printDebugger(['headers']));
            return false; // Email not sent
        }

        return true; // Email sent successfully
    }
}

// Test the function
// $to = 'husencse@gmail.com';
// $subject = "Testing";
// $message = "Testing";
// if (sendEmail($to, $subject, $message)) {
//     echo 'Email sent successfully.';
// } else {
//     echo 'Failed to send email.';
// }
