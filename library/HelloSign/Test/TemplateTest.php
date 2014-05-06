<?php

namespace HelloSign\Test;

/**
 * 
 * You must have created a template manually prior to running this test suite 
 * @author Steve Gough
 *
 */
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
     * @group update
     */
    public function testAddTemplateUser($template)
    {
    	$response = $this->client->inviteTeamMember($this->team_member_2);
        $response = $this->client->addTemplateUser($template->getId(), $this->team_member_2);

        $this->assertInstanceOf('HelloSign\Template', $response);
        $has_template = false;
		foreach($response->getAccounts() as $account) {
			if($account->email_address == $this->team_member_2 || $account->account_id == $this->team_member_2 ) {
				$has_template = true;
			}
		}
        
        $this->isTrue($has_template);
        return array($template, $this->team_member_2);
    }

    /**
     * @depends testAddTemplateUser
     * @group update
     */
    public function testRemoveTemplateUser($template_and_member)
    {
    	$template = $template_and_member[0];
    	$member = $template_and_member[1];
        $response = $this->client->removeTemplateUser($template->getId(), $member);

        $this->assertInstanceOf('HelloSign\Template', $response);
        
    	$has_template = false;
		foreach($response->getAccounts() as $account) {
			if($account->email_address == $member || $account->account_id == $member ) {
				$has_template = true;
			}
		}
        $this->isFalse($has_template);
    }
}
