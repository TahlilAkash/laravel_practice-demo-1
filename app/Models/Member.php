<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;


    public function company(){
        return $this->hasOne(Company::class);
    }

    public function companyPhoneNumbers(){
        return $this->hasOneThrough(Phone_Number::class, Company::class);}
}
