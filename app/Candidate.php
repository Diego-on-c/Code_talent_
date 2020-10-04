<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Candidate extends Model
{
    protected $fillable = ['name', 'lastname', 'email', 'promotion_id', 'phone_number', 'sololearn', 'codeacademy'];

    protected function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }

    static function updateProgress(Candidate $candidate, float $percentage, Carbon $last_connection)
    {
        DB::table('candidates')->where('id', $candidate->id)->update(['percentage' => $percentage, 'last_connection' => $last_connection]);
    }
}
