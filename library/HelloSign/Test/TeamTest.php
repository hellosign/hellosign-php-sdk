<?php

/**
 * The MIT License (MIT)
 *
 * Copyright (C) 2014 hellosign.com
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

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
        } catch (Error $e) {
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
        } catch (Error $e) {
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
    public function testInviteTeamMember($account)
    {
        $accounts_count = count($account->getAccounts());
        $response = $this->client->inviteTeamMember($this->team_member_1);
        $team = $this->client->getTeam();

        $this->assertInstanceOf('HelloSign\Team', $response);
        $this->assertNotNull($response->getName());
        $this->assertEquals(
            count($response->getAccounts()) + count($team->getInvitedAccounts()),
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
