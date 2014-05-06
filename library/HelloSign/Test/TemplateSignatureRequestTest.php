<?php

namespace HelloSign\Test;

use HelloSign\TemplateSignatureRequest;

/**
 * 
 * You must have created a template manually prior to running this test suite 
 * @author Steve Gough
 *
 */
class TemplateSignatureRequestTest extends AbstractTest
{
    /**
     * @group create
     */
    public function testSendTemplateSignatureRequest()
    {
        $templates = $this->client->getTemplates();
        $template = $templates[0];

        $request = new TemplateSignatureRequest;
        $request->enableTestMode();
        $request->setTemplateId($template->getId());
        $request->setSubject('Purchase Order');
        $request->setMessage('Glad we could come to an agreement.');

        foreach ($template->getSignerRoles() as $i => $role) {
            $request->setSigner($role->name, "george$i@example.com", "George {$role->name}");
        }
        foreach ($template->getCCRoles() as $i => $role) {
            $request->setCC($role->name, "oscar$i@example.com");
        }
        foreach ($template->getCustomFields() as $i => $field) {
            $request->setCustomFieldValue($field->name, 'My String');
        }

        $response = $this->client->sendTemplateSignatureRequest($request);

        $this->assertInstanceOf('HelloSign\SignatureRequest', $response);
        $this->assertNotNull($response->getId());

        return $response->getId();
    }
}
