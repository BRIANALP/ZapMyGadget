<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model {
    use HasFactory;
    use SoftDeletes;
    protected $table = 'job_listings';
    protected $guarded = [];
     
    protected $dates=['deleted_at'];

    public function employer(){
        return $this->belongsTo(Employer::class);
    }

    public function user(){
        return $this->belongsTo(User::class);

    }

    

}  