<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectChecklist extends Model
{
    //
    // protected $fillable = ['project_id','user_id','checklist_id','item_status'];
    protected $guarded = [];

    public function itemStatus($item_status = 1){
    	$this->update([
    		'item_status' => $item_status
    	]);
    }
    public function item_withComments(){
    	$this->itemStatus(0);
    }
    public function item_notApplicable(){
    	$this->itemStatus(2);
    }
	public function checklist_item(){
		return $this->belongsTo(Checklist::class,'checklist_id');
	}
	public function item_comments(){
		return $this->hasMany(ProjectItemComments::class);
	}

}
