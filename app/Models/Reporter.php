<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reporter extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'identify_type',
        'identify_number',
        'pob',
        'dob',
        'address',
    ];

    /**
     * Get all of the reporters for the Reporter
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reports(): HasMany
    {
        return $this->hasMany(Report::class, 'reporter_id', 'id');
    }

    /**
     * Get all of the report_tracker for the Reporter
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function report_trackers(): HasMany
    {
        return $this->hasMany(ReportTracker::class, 'reporter_id', 'id');
    }

}
