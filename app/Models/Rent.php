<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Alexo\LaravelPayU\Payable;

class Rent extends Model
{
    use HasFactory, SoftDeletes, Payable;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status',
        'start_date',
        'end_date',
        'user_id',
        'reference',
        'payu_order_id',
        'transaction_id',
        'state',
        'value'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'deleted_at',
        'updated_at'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function productRent(){
        return $this->hasMany(ProductRent::class);
    }

    public function products(){
        return $this->belongsToMany(Product::class);
    }
}
