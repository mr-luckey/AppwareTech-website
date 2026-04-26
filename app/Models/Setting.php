<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $table = 'settings';
    protected $fillable = ['key', 'value', 'type', 'group'];
    
    public static function get($key, $default = null)
    {
        try {
            if (!self::tableExists()) {
                return $default;
            }
            
            return Cache::remember("setting_{$key}", 3600, function () use ($key, $default) {
                $setting = static::where('key', $key)->first();
                return $setting ? $setting->value : $default;
            });
        } catch (\Exception $e) {
            return $default;
        }
    }
    
    public static function set($key, $value, $type = 'text', $group = 'general')
    {
        $setting = static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'type' => $type, 'group' => $group]
        );
        
        Cache::forget("setting_{$key}");
        
        return $setting;
    }
    
    private static function tableExists()
    {
        try {
            \DB::connection()->getPdo();
            return \Schema::hasTable('settings');
        } catch (\Exception $e) {
            return false;
        }
    }
}