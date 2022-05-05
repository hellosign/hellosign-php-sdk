<?php

declare(strict_types=1);

namespace HelloSignSDK\Test\Model;

use HelloSignSDK\Model\SignatureRequestSendRequest;
use HelloSignSDK\Test\HelloTestCase;
use HelloSignSDK\Test\TestUtils;

class SubFormFieldsPerDocumentTest extends HelloTestCase
{
    /**
     * @dataProvider providerSubFormFieldsPerDocumentBase
     */
    public function testSubFormFieldsPerDocumentBase(
        string $type,
        array $form_field
    ) {
        $data = [
            'form_fields_per_document' => [$form_field],
        ];

        $obj = SignatureRequestSendRequest::fromArray($data);

        $field = $obj->getFormFieldsPerDocument()[0];

        $this->assertInstanceOf("\\HelloSignSDK\\Model\\{$type}", $field);
        $this->assertEquals(
            $data['form_fields_per_document'],
            json_decode(json_encode($obj->getFormFieldsPerDocument()), true)
        );
    }

    /**
     * @dataProvider providerSubFormFieldsPerDocumentBase
     */
    public function testEmptyArrayReturnsNullValue(
        string $type,
        array $form_field
    ) {
        $data = [
            'form_fields_per_document' => [
                $form_field,
                [],
            ],
        ];

        $expected = [
            $form_field,
            null,
        ];

        $obj = SignatureRequestSendRequest::fromArray($data);

        $field = $obj->getFormFieldsPerDocument()[0];

        $this->assertInstanceOf("\\HelloSignSDK\\Model\\{$type}", $field);
        $this->assertEquals(
            $expected,
            json_decode(json_encode($obj->getFormFieldsPerDocument()), true)
        );
    }

    public function providerSubFormFieldsPerDocumentBase(): iterable
    {
        $fixtures = TestUtils::getFixtureData('SubFormFieldsPerDocument');
        foreach ($fixtures as $type => $data) {
            yield [
                'type' => $type,
                'data' => $data,
            ];
        }
    }
}
