<?php

namespace App\Actions;

class NormalizePhoneNumber
{
    public function __invoke(string $phone): string
    {
        $phone = preg_replace('/\D/', '', $phone);

        if (strlen($phone) === 10) {
            $phone = '1' . $phone;
        }

        return '+' . $phone;
    }
}
