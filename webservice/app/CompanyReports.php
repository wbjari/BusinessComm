<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyReports extends Model
{
    protected $table = 'company_reports';

    protected $fillable = ['company_id', 'reason'];

    public function reporter()
    {
    	return $this->belongsTo(User::class, 'reported_by', 'id');
    }

    public function reported()
    {
    	return $this->hasOne(Company::class, 'id', 'company_id');
    }
}