<?php

namespace Tests\LinkedSwissbibBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * DefaultControllerTest
 *
 * @author   Melanie Stucki <melanie.stucki@students.fhnw.ch>, Markus Mächler <markus.maechler@students.fhnw.ch>
 * @license  http://opensource.org/licenses/gpl-2.0.php
 * @link     http://linked.swissbib.ch
 */
class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/', [], [], ['HTTP_ACCEPT' => 'application/ld+json']);
        $response = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('Entrypoint', $response['@type']);
    }
}
