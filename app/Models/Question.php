<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'question',
        'question_category_id',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'question' => 'string',
        'question_category_id' => 'integer',
        'user_id' => 'integer'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'question';

    /*
    |--------------------------------------------------------------------------
    | One to One Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * @return BelongsTo
     **/
    public function questionCategory(): BelongsTo
    {
        return $this->belongsTo(QuestionCategory::class);
    }

    /**
     * @return BelongsTo
     **/
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
