<?php
namespace UniversalpayPayments;

/**
 *  Internal Exception
 */
class TurnkeyInternalException extends \Exception{
    protected $message = 'An internal error occurred';
    protected $code = '-1999';
}