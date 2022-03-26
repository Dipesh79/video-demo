<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoList extends Model
{
    use HasFactory;

    protected $table='video_lists';

    public $primaryKey='id';

    public $timestamps=true;

    public function video()
    {
        return $this->belongsTo('App\Models\Video');
    }

}
