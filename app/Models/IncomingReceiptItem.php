<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomingReceiptItem extends Model
{
    use HasFactory;
    protected $table = 'incoming_receipt_item';

    protected $fillable = 
    [
        'id',
        'invoice_number',
        'incoming_receipt_id',
        'product_id',
        'issue_date',
        'entry_date',
        'unit_price',
        'total_price'
    ];
}
