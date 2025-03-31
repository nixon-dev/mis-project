<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingDocx extends Model
{
    use HasFactory;

    protected $table = 'document_pending';
}
