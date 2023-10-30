<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Answers extends Model
{
    use HasFactory;

    public function questions(): BelongsTo{
        return $this->belongsTo(Questions::class);
    }

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
