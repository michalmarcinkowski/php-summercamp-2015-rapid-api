## Step 1 - Movie Entity

1. Create a new `Movie` entity in `AppBundle/Entity/Movie.php`, use generator command `doctrine:generate:entity`:

Read more about it [here](http://symfony.com/doc/current/bundles/SensioGeneratorBundle/commands/generate_doctrine_entity.html).

The entity should have the following fields and should implement ResourceInterface:

```php
<?php

namespace AppBundle\Entity;

use Sylius\Component\Resource\Model\ResourceInterface;

class Movie implements ResourceInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \DateTime
     */
    private $releaseDate;

    /**
     * @var integer
     */
    private $budget;
}
```

2. The doctrine mapping should be generated automatically, so we can generate migration for the database `doctrine:migrations:diff` command and execute it `doctrine:migrations:migrate`.

3. Configure the resource with the following lines:

```yml
# app/config/api.yml

...

sylius_resource:
    resources:
        app.movie:
            classes:
                model: AppBundle\Entity\Movie

```

4. Generate routing

```yml
# app/config/routing.yml

...

app_movie:
    resource: app.movie
    type: sylius.api

```

5. Copy tests from `tests\step-01` folder and modify `TestDataLoader.php` class:

```php
protected function getFixtures()
{
    return array(
        __DIR__.'/../TestData/movies.yml',
    );
}
```

6. Run `bin/phpunit src/` and validate you did everything correct.
