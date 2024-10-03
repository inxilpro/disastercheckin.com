<?php

use App\Data\SmsCommand;
use App\Data\SmsCommandType;
use App\Data\SmsParser;
use App\Models\CheckIn;

test('escapes body HTML', function () {
    $checkin = new CheckIn;
    $checkin->body = "<script>alert()</script>";
    expect((string)$checkin->html_body)->toBe("&lt;script&gt;alert()&lt;/script&gt;");
});


test('supports multiline body', function () {
    $checkin = new CheckIn;
    $checkin->body = "foo\n<bar>\nbaz";
    expect((string)$checkin->html_body)->toBe("foo<br>\n&lt;bar&gt;<br>\nbaz");
});
