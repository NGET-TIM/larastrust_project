<?php

namespace App\Models\Table;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableModel extends Model
{
    use HasFactory;
    protected $table = "table";
    protected $fillable = [
        'code',
        'name',
    ];
}
