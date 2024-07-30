<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityData extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'activity_data';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'activity_id',
        'type',
        'file_path',
    ];

    public $timestamps = false;

    /**
     * Get the activity that owns the data.
     */
    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function isImage()
    {
        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        return in_array($this->getFileExtension(), $imageExtensions);
    }

    public function isVideo()
    {
        $videoExtensions = ['mp4', 'avi', 'mov'];
        return in_array($this->getFileExtension(), $videoExtensions);
    }

    public function isPdf()
    {
        return $this->getFileExtension() === 'pdf';
    }

    private function getFileExtension()
    {
        return strtolower(pathinfo($this->file_path, PATHINFO_EXTENSION));
    }
}
