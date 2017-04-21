<?php

namespace jpuck\Error;

use Exception;
use Dotenv\Dotenv;
use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;

class Handler
{
    public static function getErrorType($type) {
        // http://php.net/manual/en/errorfunc.constants.php#109430
        switch($type){
            case E_ERROR: // 1 //
                return 'E_ERROR';
            case E_WARNING: // 2 //
                return 'E_WARNING';
            case E_PARSE: // 4 //
                return 'E_PARSE';
            case E_NOTICE: // 8 //
                return 'E_NOTICE';
            case E_CORE_ERROR: // 16 //
                return 'E_CORE_ERROR';
            case E_CORE_WARNING: // 32 //
                return 'E_CORE_WARNING';
            case E_COMPILE_ERROR: // 64 //
                return 'E_COMPILE_ERROR';
            case E_COMPILE_WARNING: // 128 //
                return 'E_COMPILE_WARNING';
            case E_USER_ERROR: // 256 //
                return 'E_USER_ERROR';
            case E_USER_WARNING: // 512 //
                return 'E_USER_WARNING';
            case E_USER_NOTICE: // 1024 //
                return 'E_USER_NOTICE';
            case E_STRICT: // 2048 //
                return 'E_STRICT';
            case E_RECOVERABLE_ERROR: // 4096 //
                return 'E_RECOVERABLE_ERROR';
            case E_DEPRECATED: // 8192 //
                return 'E_DEPRECATED';
            case E_USER_DEPRECATED: // 16384 //
                return 'E_USER_DEPRECATED';
        }
    }

    public static function convertErrorsToExceptions() {
        set_error_handler(function($errno, $errstr, $errfile, $errline){
            throw new Exception(Handler::getErrorType($errno).
                " line $errline in $errfile: $errstr\n", $errno
            );
        });
    }

    public static function swift()
    {
        if ( file_exists(getcwd().'/.env') ) {
            $dotenv = new Dotenv(getcwd());
            $dotenv->load();
        }

        set_exception_handler(function($exception){
            $mailer = Swift_Mailer::newInstance(
                Swift_SmtpTransport::newInstance(
                    getenv('MAIL_HOST'),
                    getenv('MAIL_PORT'),
                    getenv('MAIL_ENCRYPTION')
                )
                ->setUsername(getenv('MAIL_USERNAME'))
                ->setPassword(getenv('MAIL_PASSWORD'))
            );

            $mailer->send(Swift_Message::newInstance('EXCEPTION THROWN '.getenv('APP_NAME'))
                ->setFrom(getenv('MAIL_FROM_ADDRESS'))
                ->setTo(getenv('MAIL_ERROR_TO_ADDRESS'))
                ->setBody($exception)
            );

            throw $exception;
        });
    }
}
