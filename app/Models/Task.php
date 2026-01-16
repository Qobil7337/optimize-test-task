<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lead;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['lead_id', 'title', 'due_at', 'is_done'];

    public function lead() {
        return $this->belongsTo(Lead::class);
    }
}
