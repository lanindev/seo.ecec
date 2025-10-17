<?php
if (!function_exists('setting')) {
    function setting($key, $default = null)
    {
        return \App\Models\Setting::getValue($key, $default);
    }

}

function formatPhoneNumber(string $phone): string
{
    if (preg_match('/^\+852(\d{4})(\d{4})$/', $phone, $matches)) {
        return '+852 ' . $matches[1] . ' ' . $matches[2];
    }

    return $phone;
}
