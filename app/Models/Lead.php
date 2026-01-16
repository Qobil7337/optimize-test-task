<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;
use App\Models\User;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = ['full_name', 'phone', 'status', 'note', 'assigned_to'];

    public function tasks() {
        return $this->hasMany(Task::class);
    }

    public function user() {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
