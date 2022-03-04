<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
     protected $fillable = [
        'unique_id', 'issue_date','due_days','due_date','reference','terms_and_conditions','status','total','user_id','vat','invoice_number', 'description', 'qty', 'rate', 'amount'
    ];

   

    public function invoiceitem()
    {
        return $this->belongsTo('App\User');
    }

    
}
