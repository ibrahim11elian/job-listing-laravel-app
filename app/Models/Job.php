<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model{
    use HasFactory;

    protected $table = "jobs_listings";

    protected $fillable = [
        'title', 'salary', 'employer_id'
    ];

    // opposite to fillable be careful with it
    // protected $guarded = [];


    public function employer(){
        return $this->belongsTo(Employer::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class,'job_tags',foreignPivotKey:'job_listing_id');
    }

    public function addJob (string $title,string $salary){
        $this->title = $title;
        $this->salary = $salary;
        $this->save();
    }
}

