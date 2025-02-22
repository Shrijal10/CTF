<?php
require 'vendor/autoload.php'; // Include the Composer autoloader

use Twilio\Rest\Client;

class Sms
{
    private $client;

    public function __construct($account_sid, $auth_token)
    {
        // Initialize the Twilio client
        $this->client = new Client($account_sid, $auth_token);
    }

    public function sendSms($to, $message)
    {
        try {
            $message = $this->client->messages->create(
                $to, // To
                [
                    'from' => 'YOUR_TWILIO_PHONE_NUMBER', // From
                    'body' => $message
                ]
            );
            return $message->sid; // Return message SID if needed for reference
        } catch (Exception $e) {
            // Handle any errors that occur
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }
}

// Example usage:
// $sms = new Sms("TWILIO_ACCOUNT_SID", "TWILIO_AUTH_TOKEN");
// $sms->sendSms("+1234567890", "Hello World");
?>
