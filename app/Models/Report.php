<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Report extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;
    // use LogsActivity;

    protected $fillable = [
        'reporter_id',
        'category_id',
        'ticket_id',
        'title',
        'description',
        'status',
    ];

    /**
     * Get the reporter that owns the Report
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reporter(): BelongsTo
    {
        return $this->belongsTo(Reporter::class, 'reporter_id', 'id');
    }

    /**
     * Get the category that owns the Report
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    // public function getActivitylogOptions() : LogOptions
    // {
    //     return LogOptions::defaults()
    //     ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}");
    // }
}
