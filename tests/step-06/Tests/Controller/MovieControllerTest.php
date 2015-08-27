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

    function testCreateMovieWithoutBudget()
    {
        $this->client->request('POST', '/movies/', [
            'title' => 'Some movie',
            'description' => 'Some description',
            'releaseDate' => '2015-08-25'
        ]);

        $this->assertSuccessfulCreateResponse($this->client->getResponse(), 'movie/movie_create_without_budget');
    }

    function testCreateMovieWithoutTitle()
    {
        $this->client->request('POST', '/movies/', [
            'description' => 'Some description',
            'releaseDate' => '2015-08-25'
        ]);

        $this->assertValidationFailResponse($this->client->getResponse());
    }

    function testCreateMovieWithoutDescription()
    {
        $this->client->request('POST', '/movies/', [
            'title' => 'Some movie',
            'releaseDate' => '2015-08-25'
        ]);

        $this->assertValidationFailResponse($this->client->getResponse());
    }

    function testCreateMovieWithGenre()
    {
        $genreId = $this->createGenre(array(
            'name' => 'Fantasy'
        ));

        $this->client->request('POST', '/movies/', [
            'title' => 'Some movie',
            'description' => 'Some description',
            'releaseDate' => '2015-08-25',
            'genre' => $genreId
        ]);

        $this->assertSuccessfulCreateResponse($this->client->getResponse(), 'movie/movie_create_with_genre');
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

    function testDeleteMovieWithGenre()
    {
        $genreId = $this->createGenre(array(
            'name' => 'Fantasy'
        ));

        $movieId = $this->createMovie(array(
            'title' => 'My movie',
            'description' =>'My description',
            'releaseDate'=> '2015-08-20',
            'genre' => $genreId
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
        // load movie genres
        $genres = $loader->load(__DIR__.'/../../DataFixtures/TestData/genres.yml');
        $this->persistObjects($genres);

        $movies = $loader->load(__DIR__.'/../../DataFixtures/TestData/movies.yml');
        $this->persistObjects($movies);

        $this->defaultEntityManager->flush();
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

    /**
     * @param $objects
     *
     * @return mixed
     */
    private function persistObjects($objects)
    {
        foreach ($objects as $object) {
            $this->defaultEntityManager->persist($object);
        }
    }
}
