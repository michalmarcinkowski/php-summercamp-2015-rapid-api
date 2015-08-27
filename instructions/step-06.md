## Step 6 - Relations handling

1. Modify tests, based on requirements below.

2. Add field `genre` (together with getters and setters) with a proper typehint to the `Movie` class.

3. Configure doctrine mapping:

```yml
# AppBundle/Resources/config/doctrine/Movie.orm.yml

...

manyToOne:
        genre:
            targetEntity: Genre
            joinColumn:
                name: genre_id
                referencedColumnName: id
```

4. Generate and run migration.

5. Add another movie to the fixtures (this time with genre specified). `AppBundle/DataFixtures/TestData/movies.yml` (use `@genre1` to refer to the Genre object)

6. Add link to genre associated with the movie:

```yml
# AppBundle/Resources/config/serializer/Entity.Movie.yml

...

- rel: genre
          href:
              route: app_api_genre_show
              parameters:
                  id: expr(object.getGenre().getId())
          embedded:
              content: expr(object.getGenre())
              xmlElementName: genre
          exclusion:
              exclude_if: expr(object.getGenre() === null)

```

7. Run tests. All should be green!

