
# MRGear Persian Validator

A Laravel package for performing Persian-specific validation, including validations for Persian letters, Jalali dates, and Iranian phone numbers.

## Features

- Validation for Persian letters and spaces (for inputs that should only contain Persian letters and spaces)
- Validation for Jalali dates
- Validation for Iranian phone numbers
- Validation for phone numbers with a specific format

## Installation

To install this package, simply require it using Composer:

```bash
composer require mrgear/persian-validator
```

## Configuration

After installation, the package will be automatically enabled, and no additional configuration is needed. However, if you want to customize the error messages, you can edit Laravel's translation files.

### Custom Error Messages

To customize error messages, open the `resources/lang/fa/validation.php` file and add your own messages:

```php
return [
    'custom' => [
        'alpha_space_fa' => 'This field can only contain Persian letters and spaces.',
        'alpha_spaces' => 'This field can only contain letters and spaces.',
        'jalali_date' => 'The entered date is not valid.',
        'phone_number' => 'The phone number is not valid.',
        'ir_phone_number' => 'The phone number must start with 09 and be 11 digits long.',
    ],
];
```

## Usage

### Persian Letters and Spaces Validation

To use the `alpha_space_fa` validator, which only accepts Persian letters and spaces:

```php
$request->validate([
    'name' => 'alpha_space_fa',
]);
```

### Letters and Spaces Validation (No Persian Restriction)

To use the `alpha_spaces` validator, which only accepts letters and spaces:

```php
$request->validate([
    'name' => 'alpha_spaces',
]);
```

### Jalali Date Validation

To use the `jalali_date` validator, which only accepts valid Jalali dates:

```php
$request->validate([
    'birthdate' => 'jalali_date',
]);
```

### Iranian Phone Number Validation

To use the `phone_number` validator, which only accepts valid Iranian phone numbers:

```php
$request->validate([
    'phone' => 'phone_number',
]);
```

### Iranian Phone Number with 11 Digits Validation

To use the `ir_phone_number` validator, which only accepts Iranian phone numbers starting with 09 and containing 11 digits:

```php
$request->validate([
    'phone' => 'ir_phone_number',
]);
```

## Development and Contributing

If you would like to contribute to the development of this package, please follow these steps:

1. Fork the repository.
2. Create a new branch.
3. Make your changes.
4. Once complete, submit a pull request.

## License

This package is licensed under the MIT License. See the LICENSE file for more details.
