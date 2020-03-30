<?php

namespace App;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'report';
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public static function saveTasts($request){
        $report = new self();
        $report->user_id = $request->id;
        $report->user_report = $request->report;
        $report->date = $request->data;
        $report->save();
    }
}
