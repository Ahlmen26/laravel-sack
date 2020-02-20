<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectItemComments extends Model
{
    //
	protected $fillable = ['project_checklist_id', 'comments'];

   public function project_checklist(){
   		return $this->belongsTo(ProjectChecklist::class, 'project_checklist_id');
   }
}
