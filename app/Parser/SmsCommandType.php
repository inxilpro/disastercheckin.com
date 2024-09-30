<?php

namespace App\Parser;

enum SmsCommandType: string
{
    /**
     * User provides a status update
     */
    case Update = 'update';

    /**
     * User requests the help menu
     */
    case Help = 'help';

    /**
     * User requests to opt out
     */
    case OptOut = 'optout';

    /**
     * Invalid command
     */
    case Invalid = 'invalid';

    /**
     * Future command: check on another person via their phone number
     */
    case Search = 'search';
}
