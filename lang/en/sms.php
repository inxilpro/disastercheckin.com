<?php

return [

    /*
    |--------------------------------------------------------------------------
    | SMS Response Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines used to response to users via SMS.
    |
    */

    'opt-out' => 'Any updates you have sent will be removed from the disaster check-in website shortly.',
    // TODO: Info needs a thorough revamping
    'info' => 'To share an update on the disaster check-in website, start your message with "UPDATE" (eg. UPDATE I am doing OK!). Your message will be publicly available.',
    'check-in-received' => 'Your update has been saved. Anyone with your phone number can find your message at the disaster check-in website. Send "CANCEL" to remove all your updates.',
    'search' => [
        'invalid' => 'The phone number you searched for appears to be invalid.',
        'not-found' => 'We weren’t able to find any updates for that number. Text SUBSCRIBE followed by the phone number to be notified when this number checks in.',
    ],
];
