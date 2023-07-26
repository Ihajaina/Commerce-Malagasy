<?php

namespace App\Classe;

use Mailjet\Client;
use Mailjet\Resources;

class Mail
{
    private $api_key = '180d2dd40a3bb556d2e3094bb2635b6b';
    private $api_key_secret = '5e556d12fbfa74f1513b94620c6f1b84';

    public function send($to_email, $to_name, $subject, $content)
    {
        $mj = new Client($this->api_key, $this->api_key_secret, true,['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "commercemalagasy@gmail.com",
                        'Name' => "Commerce Malagasy"
                    ],
                    'To' => [
                        [
                            'Email' => $to_email,
                            'Name' => $to_name
                        ]
                    ],
                    'TemplateID' => 4968107,
                    'TemplateLanguage' => true,
                    'Subject' => $subject,
                    "Variables" => [
                        'content' => $content,
                    ]
                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success();
    }
}
