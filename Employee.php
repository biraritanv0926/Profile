<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $table = 'employees';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'email', 'mobile','dob','designation','doj','profile_picture'];

    public function project()
    {
        return $this->belongsToMany(Project::class, 'employees_projects', 'employees_id', 'projects_id')->withTimestamps();
    }
}