<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;
    protected $fillable=[
        'Name',
        'en_Description',
        'fr_Description',
        'star',
        'Image',
    ];
    public static function getAllTestimonial(){
        return Testimonial::with(['cat_info','sub_cat_info'])->orderBy('id','desc')->paginate(10);
    }
}
