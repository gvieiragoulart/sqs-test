<?php

namespace App\Http\Services;

use App\DTO\Sqs\Message\MessageDTO;
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
        $messageDto = $messageDto->all();

        $args = [
            'DelaySeconds' => $messageDto["delaySeconds"],
            'MessageAttributes' => [
                "Title" => [
                    'DataType' => "String",
                    'StringValue' => $messageDto["title"]
                ],
                "Author" => [
                    'DataType' => "String",
                    'StringValue' => $messageDto["author"]
                ],
                "WeeksOn" => [
                    'DataType' => "Number",
                    'StringValue' => $messageDto["weeksOn"]
                ]
            ],
            'MessageBody' => $messageDto["body"],
            'QueueUrl' => env("SQS_PREFIX")
        ];

        $this->client->sendMessage($args);
    }
}