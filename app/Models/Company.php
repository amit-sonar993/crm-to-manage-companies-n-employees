<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'logo'];

     /**
     * Get the employees for the blog post.
     */
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
