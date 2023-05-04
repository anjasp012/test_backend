<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $primaryKey = 'accountId';

    protected $fillable = ['name', 'total_point'];

    public $timestamps = false;

    public function transactions()
    {
        return $this->hasMany(Transaction::class, "accountId");
    }
}
