<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'business_name',
        'business_description',
        'business_category',
        'business_phone',
        'business_email',
        'business_address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}