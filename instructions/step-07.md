# Step 7 Collections handling

Read about SyliusResourceBundle [configuration](http://docs.sylius.org/en/latest/bundles/SyliusResourceBundle/summary.html#route-configuration-reference).

1. Write tests and responses based on the requirements below.

2. Add a `movies` field and typehint as `Doctrine\Common\Collections\Collection` (together with its getters and setters).

3. Add proper doctrine mapping:

```yml
# AppBundle/Resources/config/doctrine/Genre.orm.yml

...

oneToMany:
        movies:
            targetEntity: Movie
            mappedBy: genre
```

5. Create new route in the `app/config/routing.yml` and cover displaying all movies with given genre:

```yml
...

app_api_genre_movies:
    path: /genres/{id}/movies/
    defaults:
        _controller: app.controller.movie:indexAction
        _sylius:
            criteria:
                genre: $id
```

6. Add link to genre to be able to navigate to this route:

```yml
# AppBundle/Resources/config/serializer/Entity.Genre.yml
...

- rel: movies
          href:
              route: app_api_genre_movies
              parameters:
                  id: expr(object.getId())
```

7. Run tests. All should be green!

