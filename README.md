# PHP Magnific Validator

**MagnificValidator** is a small yet powerful validation library for PHP. Inspired by Laravel’s validation style, it allows you to validate input data using simple, expressive rule definitions.

## 🚀 Installation

Install the package via Composer:

```bash
composer require escuelait/magnific-validator
````

## ✨ Features

* Validate single values or full data arrays
* Built-in support for common rules:

  * `required`
  * `email`
  * `url`
  * `max:<value>`
* Retrieve detailed error messages after validation
* Throw exception on unknown rules
* Easy to extend with custom rule classes

## 🧪 Basic Usage

```php
use Escuelait\MagnificValidator\Validator;

$validatorFactory = new ValidatorsFactory();

// Validador de formulario

$validator = $validatorFactory->create([
    'email' => ['required', 'email'],
    'password' => ['required', 'max:16'],
]);
$errors = $validator->validate([
    'email' => 'user@example.com',
    'password' => 'secret123',
]);
if (empty($errors)) {
    echo "Valid data!";
} else {
    echo "Has validation errors:\n"; 
    print_r($errors);
}

// Validador de un campo

$validator = $validatorFactory->create(['required', 'email']);
$errors = $validator->validate('user@example.com');
if (empty($errors)) {
    echo "Valid data!";
} else {
    echo "Has validation errors:\n"; 
    print_r($errors);
}

// Validador de una regla simple 

$validator = $validatorFactory->create('email');
$errors = $validator->validate('user@example.com');
if (empty($errors)) {
    echo "Valid data!";
} else {
    echo "Has validation errors:\n"; 
    print_r($errors);
}

```

## ✅ Available Rules

| Rule       | Description                                     |
| ---------- | ----------------------------------------------- |
| `required` | The value must not be empty                     |
| `email`    | Must be a valid email address                   |
| `url`      | Must be a valid URL                             |
| `max:<n>`  | Maximum number of characters (or numeric value) |

> ⚠️ If you use an unsupported rule, an `InvalidArgumentException` will be thrown.

## ✅ Example Test Cases

MagnificValidator includes a test suite using PHPUnit with various validation scenarios.

### Valid inputs

```php
['miguel@escuela.it', ['email']],
['https://escuela.it', ['url', 'required']],
['Valid text', ['required', 'max:40']],
```

### Invalid inputs

```php
['', ['required']], // Missing required input
['invalid_email', ['email']],
['http:/bad-url', ['url']],
['Too long text...', ['max:10']],
```

## 🧪 Running Tests

Run the test suite using PHPUnit:

```bash
vendor/bin/phpunit
```

## 🧩 Custom Rules

You can extend the validator by creating your own rules. Just implement a rule class and ensure it returns a `validate()` method and a `message()` method.

## 📦 Contributions

Feel free to open issues or submit pull requests. We welcome contributions to improve the validator or add new rules.

## 📝 License

MIT License © [EscuelaIT](https://escuela.it)

