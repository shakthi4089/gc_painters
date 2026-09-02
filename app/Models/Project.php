<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'start_date' => 'date',
        'expected_end_date' => 'date',
        'completed_date' => 'date',
        'is_featured' => 'boolean',
        'show_before_after' => 'boolean',
        'total_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function images()
    {
        return $this->hasMany(ProjectImage::class)->orderBy('sort_order');
    }

    public function beforeImages()
    {
        return $this->hasMany(ProjectImage::class)->where('type', 'before');
    }

    public function duringImages()
    {
        return $this->hasMany(ProjectImage::class)->where('type', 'during');
    }

    public function afterImages()
    {
        return $this->hasMany(ProjectImage::class)->where('type', 'after');
    }

    public function updates()
    {
        return $this->hasMany(ProjectUpdate::class)->latest();
    }

    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }

    public function getBeforeImageAttribute()
    {
        $img = $this->beforeImages()->first();
        return $img ? $img->image_path : $this->cover_image;
    }

    public function getAfterImageAttribute()
    {
        $img = $this->afterImages()->first();
        return $img ? $img->image_path : $this->cover_image;
    }
}
