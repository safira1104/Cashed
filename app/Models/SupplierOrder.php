<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class SupplierOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_code',
        'product_name',
        'entry_date',
        'stock_in',
        'supplier_id'
    ];

    protected $dates = ['entry_date']; // Menandai bahwa entry_date adalah tanggal

    // Jika ingin format tanggal tertentu secara default
    public function getEntryDateAttribute($value)
    {
        return Carbon::parse($value);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
