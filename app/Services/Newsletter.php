<?php

namespace App\Services;

use MailchimpMarketing\ApiClient;

class Newsletter
{
    public function __construct(public ApiClient $client = new ApiClient())
    {
        $client->setConfig([
            "apiKey" => config("services.mailchimp.key"),
            "server" => "us21",
        ]);
    }

    public function subscribe(string $email, string $list = null): mixed
    {
        $list ??= config("services.mailchimp.lists.subscribers");

        return $this->client->lists->addListMember($list, [
            "email_address" => $email,
            "status" => "subscribed",
        ]);
    }
}
