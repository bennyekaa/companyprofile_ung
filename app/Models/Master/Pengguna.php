<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'ref_pengguna';
    //---Set Primary Key---
    protected $primaryKey = 'id';

    public $incrementing = false;
}
