# Laravel Test Framework

This library adds in test utilities and a useful framework for Laravel projects.

## Installation

### Requirements

* Laravel 7.8+
* PHPUnit 8+
* PHP 7.3+

Install using composer:

`composer require --dev package-for-laravel/testing-framework`

## Features

### Unit Test Cases

This project sets up a three-stage or level testing framework:

* *Unit* Smallest test cases that interact with only themselves.  Think string filtering class.
* *Integration* Tests that are similar to unit tests but interact with something else, like a database.  Think testing Model query scopes.
* *Feature* Feature tests test from http request to response.  Think API testing or validating a form submits successfully.

When you set up your `tests` directory, you may make three folders named after those types.  Then, you can extend a Test Case named after each.

For example, you may have the file `tests/Unit/Models/User.php` that looks like this:

```php
<?php

namespace Tests\Unit\Models;

use PackageForLaravel\TestingFramework\TestCases\UnitTestCase;

class UserTests extends UnitTestCase
{
```

These test cases expect you still have the default Laravel Framework testing setup.  Specifically, they will extend `Tests\TestCase` from your own application. (This most likely creates the application anyway so you probably have it.)

*Features for all Tests*

The `todo()` method will mark the test as incomplete.  So, if you want to come back to it later, you can do so.  This is nice because sometimes you know what you want to test at the time, but you might not be able to do so.  For example:

```php
public function testGetsFullName(): void
{
  $this->todo();
}
```

This way, you won't forget to test the full name later.  But, your tests will still execute properly.

*Features of Unit Test Case*

With Unit Test Case, an exception is thrown if a test accessed the database during execution.

*Features of Integration Test Case*

Integration test case will run the database migrations from RefreshDatabase, which sets up the transactions. It will also call all your seeders.

*Features of Feature Test Case*

The features test case includes a `createActingAs()` method.  This allows you to pass in properties that will be passed over to your `User` model factory.  When the user is created,
it will be saved to the database, then also added to a protected property `$this->actingAs` and returned as well.  By default, it will create the user model you have set in your config. You can override this with the second parameter, though.

```php
public function testUserInfoShown(): void
{
  $user = $this->createActingAs([
    'name' => 'Guy Smiley'
  ]);
  $this->get('/me')
    ->assertSee('Guy Smiley');
}
```

## Testing

Where are your tests?  That's kind of a circular reference - testing a testing framework right? But alas, there are none right now.
