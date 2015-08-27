## Step 2 - Validation

1. Add validation to our new entity in order to prevent from server exceptions.

Use YAML format and NotBlank constraint. Read more about validation [here](http://symfony.com/doc/current/book/validation.html).

The entity should have the following fields required:

* title
* description
* releaseDate

2. We should allow for `null` value for `budget` field in order to save it to the database. Make this field nullable.

Read more about Doctrine mapping [here](http://doctrine-orm.readthedocs.org/en/latest/reference/yaml-mapping.html).

3. Once it's done, we should generate migration and execute it:

```bash
app/console do:mig:diff
app/console do:mig:mig
```
run also in test environment:

```bash
app/console do:mig:mig --env=test
```

4. Write new tests to confirm we get validation errors on empty field submit and that we can create a `Movie` without the `budget`.

* testCreateMovieWithoutBudget (200)
* testCreateMovieWithoutTitle (400)
* testCreateMovieWithoutDescription (400)

**Notice:** You may need to create new json response.
**Tip:** You can find already implemented tests in the `tests/step-02` folder

5. Run `bin/phpunit src/` and validate you did everything correct.

