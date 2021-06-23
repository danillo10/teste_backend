<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomingReceipt extends Model
{
    use HasFactory;

    protected $table = 'incoming_receipt';

    protected $fillable = 
    [
        'id',
        'invoice_number',
        'plan_account_id',
        'provider_id',
        'total_price',
        'issue_date',
        'entry_date',
        'due_date',
        'retirement_date',
    ];
}
