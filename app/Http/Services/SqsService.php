<?php

namespace App\Http\Services;

use Aws\Sqs\SqsClient;

class SqsService {

    private SqsClient $client;

    public function __construct()
    {
        $this->client = new SqsClient([
            'region' => 'us-west-1',
            'version' => '2012-11-05'
        ]);
    }

    public function sendMessage(MessageDTO $messageDto): void 
    {

    }
}