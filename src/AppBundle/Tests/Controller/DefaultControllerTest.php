<?php

namespace AppBundle\Tests\Controller;

use AppBundle\Test\ApiTestCase;

class DefaultControllerTest extends ApiTestCase
{
    function testHomepage()
    {
        $this->client->request('GET', '/');

        $this->assertJsonResponseContent($this->client->getResponse(), 'default/homepage');
    }
}
