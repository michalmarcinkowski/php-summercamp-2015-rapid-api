<?php

namespace AppBundle\Tests\Controller;

use AppBundle\Test\ApiTestCase;
use Nelmio\Alice\Loader\Yaml as Loader;

class MovieControllerTest extends ApiTestCase
{
    function testCreateMovie()
    {
        $this->client->request('POST', '/movies/', [
            'title' => 'Some movie',
            'description' => 'Some description',
            'releaseDate' => '2015-08-25',
            'budget' => 10000
        ]);

        $this->assertSuccessfulCreateResponse($this->client->getResponse(), 'movie/movie_create');
    }

    public function testShowMovie404()
    {
        $this->client->request('GET', '/movies/1');

        $this->assertNotFoundResponse($this->client->getResponse());
    }

    public function testShowMovie()
    {
        $movieId = $this->createMovie(array(
            'title' => 'My movie',
            'description' =>'My description',
            'releaseDate'=> '2015-08-20',
            'budget' => 100000
        ));

        $this->client->request('GET', '/movies/'.$movieId);

        $this->assertSuccessfulGetResponse($this->client->getResponse(), 'movie/movie_show');
    }

    public function testEmptyMoviesList()
    {
        $this->client->request('GET', '/movies/');

        $this->assertSuccessfulGetResponse($this->client->getResponse(), 'movie/empty_movies_list');
    }

    public function testShowMoviesList()
    {
        $this->loadMovies();

        $this->client->request('GET', '/movies/');

        $this->assertSuccessfulGetResponse($this->client->getResponse(), 'movie/movies_list');
    }

    function testUpdateMovie()
    {
        $movieId = $this->createMovie(array(
            'title' => 'My movie',
            'description' =>'My description',
            'releaseDate'=> '2015-08-20',
            'budget' => 100000
        ));

        $this->client->request('PUT', '/movies/'.$movieId, [
            'title' => 'Not my movie',
            'description' => 'My description',
            'releaseDate' => '2015-08-20',
            'budget' => 100000
        ]);

        $this->assertSuccessfulUpdateResponse($this->client->getResponse());
    }

    function testPartialUpdateMovie()
    {
        $movieId = $this->createMovie(array(
            'title' => 'My movie',
            'description' =>'My description',
            'releaseDate'=> '2015-08-20',
            'budget' => 100000
        ));

        $this->client->request('PATCH', '/movies/'.$movieId, [
            'title' => 'Not my movie',
        ]);

        $this->assertSuccessfulPartialUpdateResponse($this->client->getResponse());
    }

    function testDeleteMovie404()
    {
        $this->client->request('DELETE', '/movies/1');

        $this->assertNotFoundResponse($this->client->getResponse());
    }

    function testDeleteMovie()
    {
        $movieId = $this->createMovie(array(
            'title' => 'My movie',
            'description' =>'My description',
            'releaseDate'=> '2015-08-20',
            'budget' => 100000
        ));

        $this->client->request('DELETE', '/movies/'.$movieId);

        $this->assertSuccessfulDeleteResponse($this->client->getResponse());
    }

    /**
     * @param array $data
     *
     * @return int Id of created movie
     */
    private function createMovie($data) {
        $this->client->request('POST', '/movies/', $data);
        $jsonResponse = json_decode($this->client->getResponse()->getContent());

        return $jsonResponse->id;
    }

    private function loadMovies()
    {
        $loader = new Loader();
        $objects = $loader->load(__DIR__.'/../../DataFixtures/TestData/movies.yml');
        foreach ($objects as $object) {
            $this->defaultEntityManager->persist($object);
        }
        $this->defaultEntityManager->flush();
    }
}
