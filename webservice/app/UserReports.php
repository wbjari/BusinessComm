<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserReports extends Model
{
    protected $table = 'user_reports';

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