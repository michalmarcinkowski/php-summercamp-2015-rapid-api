<?php

namespace AppBundle\Tests\Controller;

use AppBundle\Test\ApiTestCase;

class MovieControllerTest extends ApiTestCase
{
    function testCreateMovie()
    {
        $this->client->request('POST', '/movies/', [
            'title' => 'Some movie',
            'description' => 'Some description',
            'releaseDate' => '2015-08-25'
        ]);

        $this->assertSuccessfulCreateResponse($this->client->getResponse(), 'movie/movie_create');
    }

    public function testShowMovieResponse()
    {
        $movieId = $this->createMovie('My movie', 'My description', new \DateTime('2015-08-20'));

        $this->client->request('GET', '/movies/'.$movieId);

        $this->assertSuccessfulGetResponse($this->client->getResponse(), 'movie/movie_show');
    }

    public function testShowMoviesList()
    {
        //TODO change to alice
        for ($i = 0; $i < 3; ++$i) {
            $this->createMovie('Some movie'.$i, 'Some description'.$i, new \DateTime('2015-08-0'.$i));
        }
        $this->client->request('GET', '/movies/');

        $this->assertSuccessfulRetrieveResponse($this->client->getResponse(), 'movie/movies_list');
    }

    function testUpdateMovie()
    {
        $movieId = $this->createMovie('My movie', 'My description', new \DateTime('2015-08-20'));

        $this->client->request('PUT', '/movies/'.$movieId, [
            'title' => 'Not my movie',
            'description' => 'My description',
            'releaseDate' => '2015-08-20'
        ]);

        $this->assertSuccessfulUpdateResponse($this->client->getResponse(), 'movie/movie_update');
    }

    function testPartialUpdateMovie()
    {
        $movieId = $this->createMovie('My movie', 'My description', new \DateTime('2015-08-20'));

        $this->client->request('PUT', '/movies/'.$movieId, [
            'title' => 'Not my movie',
        ]);

        $this->assertSuccessfulPartialUpdateResponse($this->client->getResponse(), 'movie/movie_partial_update');
    }

    function testDeleteMovie()
    {
        $movieId = $this->createMovie('My movie', 'My description', new \DateTime('2015-08-20'));

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
}
