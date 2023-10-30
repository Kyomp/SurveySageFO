<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ["survey_id","question", "question_type"];
    public function survey(): BelongsTo{
        return $this->belongsTo(Survey::class, "survey_id");
    }
    public function answers(): HasMany{
        return $this->hasMany(Answer::class, "answer_id");
    }
}
