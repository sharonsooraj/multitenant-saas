<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Company;

class Employee extends Model
{
    protected $fillable = [
        'company_id',
        'name',
        'email',
        'phone',
        'designation',
        'status',
    ];

    // Relationship: Employee belongs to Company
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
