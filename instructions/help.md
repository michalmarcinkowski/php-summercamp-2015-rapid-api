### Are you stuck and not ready for the next step?

Actually, no problem! You can just skip up to the starting point of whatever
we're working on right now.

For example, if you get stuck on "Step 2 Validation", you can just
move to the `step-02` branch and keep coding along with us
on the next step (all explained below).

### How to switch to a step?

First, find out which step you want to switch to. Then, run the following
command, replacing `step02-create-product` with the name of the branch
from below. NOTE: this will delete any work you've done and move you to
**our** version of the fresh branch.

The first command removes all your work and the second command actually
switches you to the new starting point.

```bash
git clean -fd && git reset HEAD . && git checkout .
git checkout -b working origin/step03-create-product
```

The word `working` can actually be anything. If you already have a `working`
branch, just change this to anything else, like `my-second-working-branch`.

### Which step to switch to?

| If we're starting this step | Switch to this branch |
| --------------------------- | --------------------- |
| Step 2 Validation           | step-01               |
| Step 3 Serialization        | step-02               |
| Step 4 HATEOAS              | step-03               |
| Step 5 Genre entity         | step-04               |
| Step 6 Relations handling   | step-05               |
| Step 7 Collections handling | step-06               |

#### Reference links

[Doctrine mapping](http://doctrine-orm.readthedocs.org/en/latest/reference/basic-mapping.html)
[Alice](https://github.com/hautelook/AliceBundle#basic-usage)
[Doctrine migrations](http://symfony.com/doc/current/bundles/DoctrineMigrationsBundle/index.html#usage)
[HATEOAS](https://github.com/willdurand/Hateoas#usage)
[Symfony Validation](http://symfony.com/doc/current/book/validation.html)
[Sylius Resource Bundle](http://docs.sylius.org/en/latest/bundles/SyliusResourceBundle/index.html)

