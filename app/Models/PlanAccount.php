<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class PlanAccount extends Model
{
    use NodeTrait;

    protected $table = 'plan_account';
    
    protected $fillable = 
    [
        'id',
        'cod',
        'title',
        '_lft',
        "_rgt",
        "parent_id",
        "created_at",
        "updated_at"
    ];
}
