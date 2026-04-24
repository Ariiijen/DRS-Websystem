<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'title',
        'description',
        'location',
        'incident_type',
        'reporter_name',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    const INCIDENT_TYPES = [
        'earthquake' => 'Earthquake',
        'flood' => 'Flood',
        'typhoon' => 'Typhoon',
        'fire' => 'Fire',
        'landslide' => 'Landslide',
    ];

    const STATUSES = [
        'pending' => 'Pending',
        'resolved' => 'Resolved',
    ];

    public function getStatusColor(): string
    {
        return $this->status === 'resolved' ? 'green' : 'red';
    }
}