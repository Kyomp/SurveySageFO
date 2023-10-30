<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Survey extends Model
{
    use HasFactory;
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function questions(): HasMany{
        return $this->hasMany(Questions::class);
    }
}
