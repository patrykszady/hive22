<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['vendor_id', 'deposit_check', 'plaid_inst_id', 'desc', 'options'];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class)->withoutGlobalScopes();
    }
}
