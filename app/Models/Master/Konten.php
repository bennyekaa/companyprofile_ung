<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konten extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'ref_konten';
    //---Set Primary Key---
    protected $primaryKey = 'id';

    public $incrementing = false;

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, "id_kategori", "id");
    }
}
