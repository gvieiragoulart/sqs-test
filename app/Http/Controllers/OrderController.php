<?php

namespace App\Http\Controllers;

use App\DTO\Sqs\Message\MessageDTO;
use App\Http\Services\SqsService;
use App\Jobs\CreateOrder;
use Aws\Exception\AwsException;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        CreateOrder::dispatch();
        try {
            (new SqsService())->sendMessage(
                new MessageDTO(
                    delaySeconds: 10,
                    title: "title",
                    author: "me",
                    weeksOn: 6,
                    body: "body"
                )
            );
        } catch (AwsException $e) {
            // output error message if fails
            error_log($e->getMessage());
        }
    }
}
