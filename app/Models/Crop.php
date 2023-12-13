<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Crop extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'crop_id';

    protected $fillable = [
        // "crop_id",
        "name",
        "average_price",
        "sales_change",
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model){
            $model->crop_id = Str::uuid();
        });
    }
    public function records()
    {
        return $this->hasMany(Record::class, 'crop_id', 'crop_id');
    }
}
