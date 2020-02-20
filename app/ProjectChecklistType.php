<?php

namespace App;

use App\ChecklistType;
use Illuminate\Database\Eloquent\Model;

class ProjectChecklistType extends Model
{
    //
    public function checklist_type(){
    	// return $this->belongsTo(ChecklistType::class,'type');
    }
}
