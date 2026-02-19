<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skills extends Model
{
    use HasFactory;

    protected $table = 'skills';

    protected $fillable = ['name'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_skills');
    }

    public function jobs()
    {
        return $this->belongsToMany(jobs::class, 'job_skills', 'skill_id', 'job_id');
    }
}
