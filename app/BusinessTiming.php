<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessTiming extends Model
{
    public $timestamps = false;
    public const Week_DAYS = [
        0 => 'Sunday',
        1 => 'Monday',
        2 => 'Tuesday',
        3 => 'Wednesday',
        4 => 'Thursday',
        5 => 'Friday', 
        6 => 'Saturday'
    ];
  	protected $table = 'business_timing';

    protected $fillable = ['business_id', 'opening_timing', 'closing_timing', 'days', 'active'];

	public static function flipedWeek($day)
    {
        return array_search($day,self::Week_DAYS);
        //return array_flip(self::Week_DAYS);
    }
}
