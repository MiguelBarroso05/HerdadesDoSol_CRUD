<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Accommodation extends Model
{
    /** @use HasFactory<\Database\Factories\AccommodationFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = ['size','accommodation_type_id', 'description'];

    public function accommodation_types()
    {
        return $this->belongsTo(AccommodationType::class, 'accommodation_type_id');
    }
}
