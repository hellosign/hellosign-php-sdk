<?php

namespace HelloSign\Test;

use HelloSign\Event;

class EventTest extends AbstractTest
{
    public function testEventHashVerification()
    {
        $data = json_decode(json_encode(array(
            "event" => array(
                "event_time" => "1348177752",
                "event_type" => "signature_request_sent",
                "event_hash" => "7d0dace3a863bce194333c2a4e90c65f89af08e7c2068230c1c17b9c2b292dc6",
                "event_metadata" => array(
                    "related_signature_id" => "ad4d8a769b555fa5ef38691465d426682bf2c992",
                    "reported_for_account_id" => "63522885f9261e2b04eea043933ee7313eb674fd",
                    "reported_for_app_id" => null
                )
            ),
            "signature_request" => array(
                "signature_request_id" => "abcde12345"
            )
        )));

        $event = new Event($data);


        $this->assertTrue($event->isValid('4e94adf59d17c417ce0d1d2cb34b953ba7a1eebe1ecbe31bb1c586af92af1e1d'));
    }
}