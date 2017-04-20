# PHP Error Exception Handler

Converts errors to exceptions, emails everything, then re-throws exception.

## Environment Variables

Set your environment variables, or configure them in an [`.env`][1] file.

## Usage

```php
use jpuck\Error\Handler;

Handler::convertErrorsToExceptions();
Handler::swift();
```

[1]:./example.env
