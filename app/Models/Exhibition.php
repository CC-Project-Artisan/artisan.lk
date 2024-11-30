<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\ExhibitionContact;
use App\Models\ExhibitionEmail;

class Exhibition extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'exhibition_name',
        'exhibition_description',
        // 'date_option',
        // 'start_date',
        // 'end_date',
        'exhibition_date',
        'start_time',
        'end_time',
        'exhibition_location',
        'organization_name',
        // 'category_all',
        'category_name',
        'exhibitionBanner',
        'registration_start_date',
        'registration_end_date',
        'max_exhibitors',
        'vendor_entrance_fee',
        'regular_price',
        'student_price',
        'child_price',
        'social_media_links',
        'layout',
    ];

    protected $casts = [
        'social_media_links' => 'array',
    ];

    // Relationship with Contact numbers
    public function contacts()
    {
        return $this->hasMany(ExhibitionContact::class);
    }

    // Relationship with Emails
    public function emails()
    {
        return $this->hasMany(ExhibitionEmail::class);
    }
}
