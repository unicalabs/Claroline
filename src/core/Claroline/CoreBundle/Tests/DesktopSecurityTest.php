<?php

namespace Claroline\CoreBundle;

use Claroline\CoreBundle\Library\Testing\FunctionalTestCase;

class DesktopSecurityTest extends FunctionalTestCase
{
    protected function setUp()
    {
        parent::setUp();
        $this->loadUserFixture();
        $this->client->followRedirects();
    }
    
    public function testDesktopSectionRequiresAuthenticatedUser()
    {
        $crawler = $this->client->request('GET', '/desktop');        
        $this->assertTrue($crawler->filter('#login_form')->count() > 0);
    }
    
    public function testAccessToDesktopSectionIsAllowedToSimpleUsers()
    {
        $this->logUser($this->getFixtureReference('user/user'));        
        $crawler = $this->client->request('GET', '/desktop');
        $this->assertTrue($crawler->filter('#desktop.section')->count() > 0);
    }
}