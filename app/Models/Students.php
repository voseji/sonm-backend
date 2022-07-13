<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;
    protected $table = 'students';

    protected $fillable = ['registrationNumber','formNumber', 'firstName', 'lastName', 'otherNames', 'email', 'gender', 'maritalStatus', 'dateOfBirth', 'phoneNumber1', 'phoneNumber2', 'stateOfOrigin', 'lga', 'nationality', 'batch'];

}
