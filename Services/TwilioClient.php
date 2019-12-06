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
     * @throws \Twilio\Exceptions\ConfigurationException
     *
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
     * @param null $mediaUrl
     * @return \Twilio\Rest\Api\V2010\Account\MessageInstance
     * @throws \Twilio\Exceptions\TwilioException
     */
    public function sendWhatsAppMessage($to, $from, $body, $mediaUrl = null)
    {
        return $this->sendMessage($to, $from, $body, self::MESSAGE_WHATSAPP, $mediaUrl);
    }

    /**
     * @param $to
     * @param $from
     * @param $body
     * @param null $mediaUrl
     * @return \Twilio\Rest\Api\V2010\Account\MessageInstance
     * @throws \Twilio\Exceptions\TwilioException
     */
    public function sendSMSMessage($to, $from, $body, $mediaUrl = null)
    {
        return $this->sendMessage($to, $from, $body, self::MESSAGE_SMS, $mediaUrl);
    }

    /**
     * @param $to
     * @param $from
     * @param $body
     * @param $type
     * @param null $mediaUrl
     * @return \Twilio\Rest\Api\V2010\Account\MessageInstance
     * @throws \Twilio\Exceptions\TwilioException
     */
    private function sendMessage($to, $from, $body, $type, $mediaUrl = null)
    {
        if ($type == self::MESSAGE_WHATSAPP) {
            $to = "whatsapp:{$to}";
            $from =  "whatsapp:{$from}";
        }

        $bodyArray = [
            "from" => $from,
            "body" => $body
        ];

        if ($mediaUrl)  $bodyArray['mediaUrl'] = [$mediaUrl];

        return $this->service->messages->create(
                $to, // to
                $bodyArray
        );
    }

}