<?php

namespace Electro\App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmailLink extends Model
{
    use HasFactory;

    protected $fillable = [
        "slug",
        "expire_at",
        "is_used",
        "user_id"
    ];
    

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}