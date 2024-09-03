<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventData extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'event_id',
        'type',
        'file_path',
    ];

    public $timestamps = false;

    /**
     * Obtenir l'événement auquel les données appartiennent.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Vérifie si le fichier est une image.
     *
     * @return bool
     */
    public function isImage()
    {
        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        return in_array($this->getFileExtension(), $imageExtensions);
    }

    /**
     * Vérifie si le fichier est une vidéo.
     *
     * @return bool
     */
    public function isVideo()
    {
        $videoExtensions = ['mp4', 'avi', 'mov'];
        return in_array($this->getFileExtension(), $videoExtensions);
    }

    /**
     * Vérifie si le fichier est un PDF.
     *
     * @return bool
     */
    public function isPdf()
    {
        return $this->getFileExtension() === 'pdf';
    }

    /**
     * Obtient l'extension du fichier.
     *
     * @return string
     */
    private function getFileExtension()
    {
        return strtolower(pathinfo($this->file_path, PATHINFO_EXTENSION));
    }
}
