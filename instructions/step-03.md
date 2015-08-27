## Step 3 - Serializer

In order to format date correctly and hide sensitive information we have to configure the serializer for our entity.

1. We should display `releaseDate` as a date (without time and timezone) and the sensitive field `budget` should be hidden. Modify the responses to the following rules.

2. Run `bin/phpunit src/`. You should see some failing tests.

3. Create new file `AppBundle/Resources/config/serializer/Entity.Movie.yml` and fill it with the following data:

```yml
AppBundle\Entity\Movie:
    exclusion_policy: ALL
    xml_root_name: movie
    properties:
        id:
            expose: true
            type: integer
            xml_attribute: true
        title:
            expose: true
            type: string
        description:
            expose: true
            type: string
        releaseDate:
            expose: true
            type: DateTime<'Y-m-d'>
```

4. Clear cache `app/console cache:clear` and `app/console cache:clear --env=test`.

5. Run the tests again. You should see all green!

