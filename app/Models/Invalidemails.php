<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invalidemails extends Model
{
    use HasFactory;
    protected $table="invalidemails";
    protected $primaryKey="id";
}
