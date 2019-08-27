<?php

namespace DriveOp\TwilioBundle\Services;

use Twilio\Rest\Client;

class TwilioClient
{
    protected $sid;
    protected $token;

    /** @var Client  */
    protected $service;

    public function __construct($twilio_sid, $twilio_token)
    {
        // Create an Twilio client object
        $this->service = new Client($twilio_sid, $twilio_token);
    }

    public function sendWhatsAppMessage($to, $from, $body)
    {
        $message = $this->service->messages
            ->create("whatsapp:{$to}", // to
                array(
                    "from" => "whatsapp:{$from}",
                    "body" => $body
                )
            );

        return $message;
    }

}