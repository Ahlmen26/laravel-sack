<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    //
    // protected $fillable = ['name','osi','owner'];
    protected $guarded = [];

    public function project_owner(){
    	return $this->belongsTo(User::class, 'owner');
    }
    public function surveytype(){
    	return $this->belongsTo(SurveyType::class, 'survey_type');
    }
    public function peer(){
    	return $this->belongsTo(User::class, 'proofer');
    }
    public function project_checklist(){
    	return $this->hasMany(ProjectChecklist::class,'project_id');
    }
    public function checklist_types(){
        return $this->hasMany(ProjectChecklistType::class, 'project_id');
    }
    public function getRouteKeyName()
    {
        return 'name';
    }

}
