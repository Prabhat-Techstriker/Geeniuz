<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business_awards extends Model
{
    protected $table = 'business_awards';

    protected $fillable = ['business_id', 'awards'];

    public function Business() {
        return $this->belongsTo('App\Business', 'business_id');
    }
}
