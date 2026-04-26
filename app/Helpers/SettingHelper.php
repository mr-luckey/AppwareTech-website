<?php

namespace App\Helpers;

use App\Models\Setting;

class SettingHelper
{
    public static function get($key, $default = null)
    {
        try {
            $setting = Setting::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        } catch (\Exception $e) {
            return $default;
        }
    }
}