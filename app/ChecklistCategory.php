<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChecklistCategory extends Model
{
    // Instantiate protected fields fillable
    protected $fillable = ['id','checklist_type','category_name'];
}
