<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    protected $table = 'reports';

    protected $fillable = ['user_id', 'reason'];

    public function reporter()
    {
    	return $this->belongsTo(User::class, 'reported_by', 'id');
    }

    public function reported()
    {
    	return $this->hasOne(User::class, 'id', 'user_id');
    }
}
	