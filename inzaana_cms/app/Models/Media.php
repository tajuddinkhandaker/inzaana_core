<?php

namespace Inzaana;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    //
    protected $table = 'medias';
    protected $guarded = [];

    public function template()
    {    	
        return $this->belongsTo('Inzaana\Template');
    }
}
