# PHP Error Exception Handler

Converts errors to exceptions, emails everything, then re-throws exception.

## Installation

Use [composer][2].

    composer require jpuck/error-exception-handler

This package targets legacy systems running php 5.3.3
so newer systems may conflict with requiring [swift][swift] 5.

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
[swift]:https://swiftmailer.symfony.com/
