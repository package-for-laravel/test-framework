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

*Features of Unit Test Case*

With Unit Test Case, an exception is thrown if a test accessed the database during execution.

*Features of Integration Test Case*

Integration test case will run the database migrations from RefreshDatabase, which sets up the transactions. It will also call all your seeders.

Feature test case just extends the integration test case at this time.


## Testing

Where are your tests?  That's kind of a circular reference - testing a testing framework right? But alas, there are none right now.
