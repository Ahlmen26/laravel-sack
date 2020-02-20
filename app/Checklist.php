<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    //
    protected $guarded = [];

    public function category_item(){
        return $this->belongsTo(ChecklistCategory::class, 'category');
    }
    public function checklistType(){
        return $this->belongsTo(ChecklistType::class, 'checklist_type');
    }
    public function surveyType(){
        return $this->belongsTo(SurveyType::class, 'survey_type');
    }
    public function jira_category() {
        return $this->belongsTo(JiraTemplate::class, 'jira_temp_id');
    }
    
}
