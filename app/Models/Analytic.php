<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Analytic extends Model
{
    protected $table = 'analytics';
    
    protected $fillable = ['page_url', 'ip_address', 'user_agent', 'views', 'date'];

    protected $casts = [
        'date' => 'date',
    ];

    public static function track($pageUrl)
    {
        $today = Carbon::today();
        
        $analytic = static::firstOrCreate([
            'page_url' => $pageUrl,
            'date' => $today,
        ]);

        $analytic->increment('views');
    }

    public static function getPageViews($pageUrl, $days = 30)
    {
        return static::where('page_url', $pageUrl)
            ->where('date', '>=', Carbon::now()->subDays($days))
            ->orderBy('date')
            ->get();
    }
}