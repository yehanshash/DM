<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilteredPrice extends Model
{
    protected $table = 'filtered_car_dataset';
    protected $fillable = [
        'make', 'model', 'model_year'
    ];
}
