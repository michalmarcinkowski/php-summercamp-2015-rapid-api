<?php

namespace AppBundle\Tests\Controller;

use AppBundle\Test\ApiTestCase;
use Nelmio\Alice\Loader\Yaml as Loader;

class GenreControllerTest extends ApiTestCase
{
    function testCreateGenre()
    {
        $this->client->request('POST', '/genres/', [
            'name' => 'Drama',
        ]);

        $this->assertSuccessfulCreateResponse($this->client->getResponse(), 'genre/genre_create');
    }

    function testCreateGenreWithoutName()
    {
        $this->client->request('POST', '/genres/', [
        ]);

        $this->assertValidationFailResponse($this->client->getResponse());
    }

    public function testShowGenre404()
    {
        $this->client->request('GET', '/genres/1');

        $this->assertNotFoundResponse($this->client->getResponse());
    }

    public function testShowGenre()
    {
        $genreId = $this->createGenre(array(
            'name' => 'Fantasy',
        ));

        $this->client->request('GET', '/genres/'.$genreId);

        $this->assertSuccessfulGetResponse($this->client->getResponse(), 'genre/genre_show');
    }

    public function testEmptyGenresList()
    {
        $this->client->request('GET', '/genres/');

        $this->assertSuccessfulGetResponse($this->client->getResponse(), 'genre/empty_genres_list');
    }

    public function testShowGenresList()
    {
        $this->loadGenres();

        $this->client->request('GET', '/genres/');

        $this->assertSuccessfulGetResponse($this->client->getResponse(), 'genre/genres_list');
    }

    function testUpdateGenre()
    {
        $genreId = $this->createGenre(array(
            'name' => 'Darrma',
        ));

        $this->client->request('PUT', '/genres/'.$genreId, [
            'name' => 'Drama',
        ]);

        $this->assertSuccessfulUpdateResponse($this->client->getResponse());
    }

    function testDeleteGenre404()
    {
        $this->client->request('DELETE', '/genres/1');

        $this->assertNotFoundResponse($this->client->getResponse());
    }

    function testDeleteGenre()
    {
        $genreId = $this->createGenre(array(
            'name' => 'Drama',
        ));

        $this->client->request('DELETE', '/genres/'.$genreId);

        $this->assertSuccessfulDeleteResponse($this->client->getResponse());
    }

    /**
     * @param array $data
     *
     * @return int Id of created genre
     */
    private function createGenre($data) {
        $this->client->request('POST', '/genres/', $data);
        $jsonResponse = json_decode($this->client->getResponse()->getContent());

        return $jsonResponse->id;
    }

    private function loadGenres()
    {
        $loader = new Loader();
        $objects = $loader->load(__DIR__.'/../../DataFixtures/TestData/genres.yml');
        foreach ($objects as $object) {
            $this->defaultEntityManager->persist($object);
        }
        $this->defaultEntityManager->flush();
    }
}
