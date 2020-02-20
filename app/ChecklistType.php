<?php

namespace App;

use App\ProjectChecklistType;
use Illuminate\Database\Eloquent\Model;

class ChecklistType extends Model
{
    // Intantiate protected fillable
    protected $fillable = ['type'];
    
    public function project(){
    	return $this->belongsTo(Projects::class);
    }
}
