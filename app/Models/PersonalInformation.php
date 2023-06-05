<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalInformation extends Model
{
    use HasFactory;

    protected $table = 'personal_information';

    protected $fillable = [
        'user_id',
        'description',
        'photo_profile',
        'path_photo_profile'
    ];


    public function user(){
        return $this->belongsTo(User::class, 'id');
    }
}
