<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankingDetails extends Model
{
    use HasFactory;
    protected $table='banking_details';
    protected $fillable=['id','balance','fk_user_id','amount','type','details','balance','created_at','updated_at'];
}
