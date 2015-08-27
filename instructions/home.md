### Welcome to the Lionframe workshop!

A) Start up the virtual machine! Here are the [Virtual Machine Instructions](https://github.com/netgen/summercamp-2015/blob/master/README.md)

B) From the command line, `ssh` into the machine and move into our directory

```bash
vagrant ssh
cd /var/www/summercamp/workshops/lionframe
```

C) Make sure you have the latest code by running:

```
git fetch origin
git checkout master
git pull origin master
composer install
```

D) Run `bin/phpunit src/` and ensure it's green (if not ask for help).

E) Finally you should be able to go to
`http://lionframe.phpsc/` and see an xml response!

