# Befree
befree is a free open source php framework.

## Getting started
As you download the framework's files and launch it on apache2, everything will already be working.
### File structure
![app, config, core, db, public, tests, vendor, composer.json, composer.lock, index.php, migrate.php, phpunit.xml](https://i.ibb.co/02r0hRC/Screenshot-2019-01-28-14-23-04.png)

**app**

This folder will contain controllers and models that you will create.

**config**

This folder is used for giving the framework data about your app, database and so on.

**core**

You must never touch this folder, there are core files located inside it. If you change something, framework can stop working.

**db**

This folder is meant to be used for keeping migrations and file databases (sqlite3) inside.

**public**

There are views and assets in this folder.

**tests**

This folder contains all the tests you create for your app.

**vendor**

This is a folder created by composer.

**migrate.php**

This file, if it exists, works whenever you go to your site. You can use commands for migrating there.

<hr/>

### Routes

Routes are located in `config/urls.php`

By default the file with routes looks like this:

![image](https://i.ibb.co/Zcz9bHq/Screenshot-2019-01-28-14-40-37.png)

You can create new routes by using the methods `get()` and `post()` of the object `$router`. The method takes 2 parameters (route and controller).
route must look like this 'shop/items' without slashes at the start and the end of a string.

The second parameter have to look like 'name_of_the_controller@name_of_the_method'.

In order to use parameters in url you need to use {} around the name of a parameter. (For example 'users/{id}'). The parameter will be in the array $parameters that will be given as the first parameter to your controller.

Use the method _404 to choose a controller and its method for handling unknown routes. It takes only one parameter that is controller.

## We're not done with this tutorial yet
