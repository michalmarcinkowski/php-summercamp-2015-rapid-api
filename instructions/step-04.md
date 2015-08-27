## Step 4 - HATEOAS

1. Add HATEOAS link to the entity. Modify the serializer file.

```yml
#AppBundle/Resources/config/serializer/Entity.Movie.yml

...

relations:
        - rel: self
          href:
              route: app_api_movie_show
              parameters:
                  id: expr(object.getId())
```

2. Check the responses and correct the tests to make them green.

