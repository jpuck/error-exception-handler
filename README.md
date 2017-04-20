# PHP Error Exception Handler

Converts errors to exceptions, emails everything, then re-throws exception.

## Installation

Use [composer][2].

    composer require jpuck/error-exception-handler

## Environment Variables

Set your environment variables, or configure them in an [`.env`][1] file.

## Usage

```php
use jpuck\Error\Handler;

Handler::convertErrorsToExceptions();
Handler::swift();
```

[1]:./example.env
[2]:https://getcomposer.org/
