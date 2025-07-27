<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model

{

    protected $fillable = [
        'company_id', 'invoice_number', 'client_id', 'project_id',
        'issue_date', 'due_date', 'gst_amount', 'grand_total', 'notes'
    ];
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}
