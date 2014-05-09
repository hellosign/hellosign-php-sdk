<?php

namespace HelloSign\Test;

use HelloSign\Team;
use HelloSign\Error;

class TeamTest extends AbstractTest
{
    /**
     * @group destroy
     */
    public function testRemoveAllTeamMembers()
    {
        try {
            $response = $this->client->removeAllTeamMembers();
            $accounts = $response->getAccounts();

            $this->assertInstanceOf('HelloSign\Team', $response);
            $this->assertNotNull($response->getName());
            // A team can have more than 1 admin
            $this->assertGreaterThan(0, count($accounts));
        }
        catch (Error $e) {
            if ($e->getMessage() != 'Team does not exist') {
                throw $e;
            }
        }
    }

    /**
     * @depends testRemoveAllTeamMembers
     * @group destroy
     */
    public function testDestroyTeam()
    {
        try {
            $response = $this->client->destroyTeam();
            $this->assertTrue($response);
        }
        catch (Error $e) {
            if ($e->getMessage() != 'No team to delete') {
                throw $e;
            }
        }
    }

    /**
     * @depends testDestroyTeam
     * @group create
     */
    public function testCreateTeam()
    {
        $name = 'SSS'.time();
        $response = $this->client->createTeam(new Team($name));

        $this->assertInstanceOf('HelloSign\Team', $response);
        $this->assertEquals($response->getName(), $name);
    }

    /**
     * @depends testCreateTeam
     * @group update
     */
    public function testUpdateTeamName()
    {
        $name = 'SSS'.time();
        $response = $this->client->updateTeamName($name);

        $this->assertInstanceOf('HelloSign\Team', $response);
        $this->assertEquals($response->getName(), $name);

        return $response;
    }

    /**
     * @depends testUpdateTeamName
     * @group update
     */
    public function testInviteTeamMember($team)
    {
        $accounts_count = count($team->getAccounts());
        $response = $this->client->inviteTeamMember($this->team_member_1);

        $this->assertInstanceOf('HelloSign\Team', $response);
        $this->assertNotNull($response->getName());
        $this->assertEquals(
            count($response->getAccounts()),
            $accounts_count + 1
        );
    }


    /**
     * @depends testCreateTeam
     * @group read 
     */
    public function testGetTeam()
    {
        $response = $this->client->getTeam();

        $this->assertInstanceOf('HelloSign\Team', $response);
    }
}
