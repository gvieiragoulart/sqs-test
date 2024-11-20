<?php

namespace App\Http\Controllers;

use App\Jobs\CreateOrder;
use Aws\Exception\AwsException;
use Aws\Sqs\SqsClient;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {

        
        $params = [
            'DelaySeconds' => 10,
            'MessageAttributes' => [
                "Title" => [
                    'DataType' => "String",
                    'StringValue' => "The Hitchhiker's Guide to the Galaxy"
                ],
                "Author" => [
                    'DataType' => "String",
                    'StringValue' => "Douglas Adams."
                ],
                "WeeksOn" => [
                    'DataType' => "Number",
                    'StringValue' => "6"
                ]
            ],
            'MessageBody' => "Information about current NY Times fiction bestseller for week of 12/11/2016.",
            'QueueUrl' => env("SQS_PREFIX")
        ];
        
        try {
            $result = $client->sendMessage($params);
            var_dump($result);
        } catch (AwsException $e) {
            // output error message if fails
            error_log($e->getMessage());
        }
        
        
    }
}
