<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Company;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id', 'name', 'email', 'phone', 'designation', 'status'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
