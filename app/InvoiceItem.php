<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    //


    protected $fillable = [
        'invoice_id', 'description','qty','rate','amount'
    ];
    
    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }
}



