<?php

function setting(string $code)
{
    if (null === $setting = \App\Models\Setting::where('code', $code)->first()) {
        return "Impossible de trouver un paramètre avec le code $code";
    }

    return $setting->value;
}
