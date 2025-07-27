<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Project extends Model
{
    protected $fillable = [
        'client_id',
        'company_id',
        'title',
        'description',
        'start_date',
        'end_date',
        'status',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
