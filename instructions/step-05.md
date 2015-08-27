## Step 5 - Genre Entity

1. Write tests and responses based on the requirements below.

2. Generate new entity: `AppBundle/Entity/Genre.php` only with the `name` field and implement ResourceInterface.

3. Generate and run migration.

4. Register genre as a resource (same as with `Movie`). `app/config/api.yml`

5. Generate routing for Genre (same as with `Movie`). 'app/config/routing.yml`

6. Create fixtures. `src/AppBundle/DataFixtures/TestData/genres.yml`

7. Add fixtures loading to the `TestDataLoader.php`.

8. Validate the fixtures are loading. Run `app/console doctrine:fixtures:load` and send a request to the app to check if the data exist.

9. Create serializer file with name and id exposed and `self` relation link added.

10. Configure the validation. Name should not be blank.

11. Run tests. All should be green!

