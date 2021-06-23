<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentsAdministrative extends Model
{
    use HasFactory;
    protected $table = 'documents_administratives';

    protected $fillable = [
        'administrative_tasks_id',
        'directory'
    ];


}
