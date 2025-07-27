<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User; // Import the User model
use App\Models\Employee;
use App\Models\Client;
use App\Models\Project;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'address',
        'industry',
        'email',
        'phone',
        'status', // Example: 'active' or 'inactive'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
    public function clients()
    {
        return $this->hasMany(Client::class);
    }
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
