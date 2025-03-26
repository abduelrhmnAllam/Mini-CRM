<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['admin_id', 'employee_id', 'name', 'email', 'phone'];


    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    public function actions()
    {
        return $this->hasMany(Action::class);
    }
}
