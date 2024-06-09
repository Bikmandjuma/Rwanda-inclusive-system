<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pdf extends Model
{
    use HasFactory;

    protected $fillable = [
        'result_id', 'pdf_path'
    ];

    public function result()
    {
        return $this->belongsTo(Result::class);
    }
}
