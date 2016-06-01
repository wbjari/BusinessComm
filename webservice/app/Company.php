<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    public function reports()
    {
        return $this->hasMany(Reports::class, 'reported_by', 'id');
    }
}
