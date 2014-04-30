<?php

namespace HelloSign\Test;

class TemplateTest extends AbstractTest
{
    /**
     * @group read
     * @expectedException HelloSign\Error
     * @expectedExceptionMessage Page not found
     */
    public function testGetTemplatesWithPageNotFound()
    {
        $templates = $this->client->getTemplates(9999);
    }

    /**
     * @group read
     */
    public function testGetTemplates()
    {
        $templates = $this->client->getTemplates();
        $template = $templates[0];

        $template2 = $this->client->getTemplate($template->getId());


        $this->assertInstanceOf('HelloSign\TemplateList', $templates);
        $this->assertGreaterThan(0, count($templates));

        $this->assertInstanceOf('HelloSign\Template', $template);
        $this->assertNotNull($template->getId());

        $this->assertInstanceOf('HelloSign\Template', $template2);
        $this->assertNotNull($template2->getId());

        $this->assertEquals($template, $template2);


        return $template;
    }

    /**
     * @depends testGetTemplates
     * @expectedException HelloSign\Error
     * @expectedExceptionMessage Account does not belong to your team
     * @group update
     */
    public function testAddTemplateUser($template)
    {
        $response = $this->client->addTemplateUser($template->getId(), $_ENV['TEAMMATE_ID_OR_EMAIL']);

        $this->assertInstanceOf('HelloSign\Template', $response);
        $this->assertEquals($response, $template);
    }

    /**
     * @depends testGetTemplates
     * @expectedException HelloSign\Error
     * @expectedExceptionMessage Account does not belong to your team
     * @group update
     */
    public function testRemoveTemplateUser($template)
    {
        $response = $this->client->removeTemplateUser($template->getId(), $_ENV['TEAMMATE_ID_OR_EMAIL']);

        $this->assertInstanceOf('HelloSign\Template', $response);
        $this->assertEquals($response, $template);
    }
}
