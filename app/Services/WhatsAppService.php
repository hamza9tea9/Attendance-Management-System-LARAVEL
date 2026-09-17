<?php

namespace App\Services;

use Twilio\Rest\Client;

class WhatsAppService
{
    public static function sendMessage($to, $message)
    {
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $from = env('TWILIO_WHATSAPP_FROM');

        $client = new Client($sid, $token);

        $client->messages->create(
            "whatsapp:$to",
            [
                'from' => $from,
                'body' => $message
            ]
        );
    }
}
