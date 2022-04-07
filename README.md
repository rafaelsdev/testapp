# Simple Test Application

Welcome to the CLI simple test application;

>[!NOTE]
>Database Schema is located under /migration folder
>

Folder structucre is as follows:

> AppTest
> |
> - conf
> -- config.ini.php (DB connection settings)
> - src (Main files)
> -- Command (where the magic happens)
> -- Controller (Application logic should be here)
> -- Model (Database operations and stuff)
> - tests (name says)
> - vendor (third party stuff)

All you have to do is clone this app and run it using the following commands:

*Create User*
```sh
php index.php ASPTest:create-user 
```

Create user expects the following parameters:

|param|type|length|nullable|
|--|--|--|--|
|First Name|string| min 2 max 35|no
|Last Name|string|min 2 max 35|no
|E-mail|string|max 150|no
|Age|Number|min 1 to 150|yes

Parameters must be passed in the same order as shown above.

*Add Password*
```sh
php index.php ASPTest:password-create
```
Password Creation expects the following parameters:

|param|type|length|nullable|
|--|--|--|--|
|User Id| Number | 10 | no
|Password| string | Min 6 Max 150| no
|Password Confirmation| string | Min 6 Max 150| no

Parameters must be passed in the same order as shown above.

Application logic will be applied on the Commands itself, Controller is working as a layer between the Commands and Model, but feel free to add more validations to it

To get the database running just run the setup.sql on migration folder in the editor of your choice.

Database connection settings *must* be set on the conf/config.ini.php file

The applcation comes shipped with basic unit tests, under the tests folder, you can improve its code coverage. To run tests use the following:

Older versions of PHPUnit
```sh
php vendor/bin/phpunit tests
```

Newer Versions 
```sh
phpunit tests/UserTest.php
```

Feel free to improve this document!