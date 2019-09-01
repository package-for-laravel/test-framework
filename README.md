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

* **Unit** Smallest test cases that interact with only themselves.  Think string filtering class.
* **Integration** Tests that are similar to unit tests but interact with something else, like a database.  Think testing Model query scopes.
* **Feature** Feature tests test from http request to response.  Think API testing or validating a form submits successfully.

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

**Features for all Tests**

The `todo()` method will mark the test as incomplete.  So, if you want to come back to it later, you can do so.  This is nice because sometimes you know what you want to test at the time, but you might not be able to do so.  For example:

```php
public function testGetsFullName(): void
{
  $this->todo();
}
```

This way, you won't forget to test the full name later.  But, your tests will still execute properly.

**Features of Unit Test Case**

With Unit Test Case, an exception is thrown if a test accessed the database during execution.

**Features of Integration Test Case**

Integration test case will run the database migrations from RefreshDatabase, which sets up the transactions. It will also call all your seeders.

**Features of Feature Test Case**

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

Next, it features the method `noAuthRedirectTest()` which takes a url. This will validate that the user is redirected if they are not authenticated.

You can also specify the method of http request as the second parameter.  By default, the redirect to is a route named `login` but you can override this as the third parameter.

```php
public function testDashboardRequiresUserAuth(): void
{
  $this->noAuthRedirectTest(route('dashboard'));
}

public function testUpdateProfileRequiresAuth(): void
{
  $this->noAuthRedirectTest(route('users.update'), 'PUT');
}
```

### Deep Inspection

Very rarely should you need to do deep inspection of your methods and properties in your unit testing.  However, sometimes it becomes so hard
to develop a complex mocking system (or a collection of final classes make it impossible to) that it requires you to call and access non-public properties and methods.
While this is not recommended (and if you find yourself using this functionality often, you should consider it a code smell), you can do so with the following functionality:

First, register the global helpers in your PHPUnit bootstrap.  You can do so like this:

```php

PackageForLaravel\TestingFramework\Testing::globalInspection();
```

Now, you will have the following functionality:

`callMethod()` which calls a method deeply on a class and returns the value.

For example:

```php
class Mine
{
  protected function hiddenFunctionality(string $name): string
  {
    return $name . ' has secrets!';
  }
}

public function testSecretsGeneratedProperly(): void
{
  $mine = new Mine();
  $this->assertEquals('aaron has secrets!', callMethod($mine, 'hiddenFunctionality', ['aaron']));
}
```

`getProperty()` is basically the same functionality, but to get a property.

```php
class Mine
{
  protected $about = '';

  public function __construct()
  {
    $this->about = 'me';
  }
}

public function testItsAllAboutMe(): void
{
  $mine = new Mine();
  $this->assertEquals('me', getProperty($mine, 'about'));
}
```

## Testing

Where are your tests?  That's kind of a circular reference - testing a testing framework right? But alas, there are none right now.

## Credits

This package is created and maintained by [Aaron Saray](https://github.com/aaronsaray) 
