<?php

namespace DriveOp\TwilioBundle\Services;

use Twilio\Rest\Client;

class TwilioClient
{
    protected $sid;
    protected $token;

    /** @var Client  */
    protected $service;

    const MESSAGE_SMS = 'sms';
    const MESSAGE_WHATSAPP = 'whatsapp';

    /**
     * TwilioClient constructor.
     * @param $twilio_sid
     * @param $twilio_token
     */
    public function __construct($twilio_sid, $twilio_token)
    {
        // Create an Twilio client object
        $this->service = new Client($twilio_sid, $twilio_token);
    }

    /**
     * @param $to
     * @param $from
     * @param $body
     * @return mixed
     */
    public function sendWhatsAppMessage($to, $from, $body)
    {
        return $this->sendMessage($to, $from, $body, self::MESSAGE_WHATSAPP);
    }

    /**
     * @param $to
     * @param $from
     * @param $body
     * @return mixed
     */
    public function sendSMSMessage($to, $from, $body)
    {
        return $this->sendMessage($to, $from, $body, self::MESSAGE_SMS);
    }

    /**
     * @param $to
     * @param $from
     * @param $body
     * @param $type
     * @return mixed
     */
    private function sendMessage($to, $from, $body, $type)
    {
        if ($type == self::MESSAGE_WHATSAPP) {
            $to = "whatsapp:{$to}";
            $from =  "whatsapp:{$from}";
        }

        $message = $this->service->messages
            ->create(
                $to, // to
                [
                    "from" => $from,
                    "body" => $body
                ]
            );

        return $message;
    }

}