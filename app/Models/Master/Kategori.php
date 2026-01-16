<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'ref_kategori';
    //---Set Primary Key---
    protected $primaryKey = 'id';

    public $incrementing = false;
}
