<?php

namespace App\Parser;

enum SmsCommandType: string
{
    /**
     * User provides an update to the service
     */
    case Update = 'update';

    /**
     * User requests the help menu
     */
    case Help = 'help';

    /**
     * User requests the help menu
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
