<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Validemails extends Model
{
    use HasFactory;
    protected $table = "validemails";
    protected $primaryKey = "id";
}
