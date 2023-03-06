<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'company_id'];

    /**
     * Get the post that owns the comment.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
