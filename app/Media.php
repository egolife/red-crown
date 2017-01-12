<?php

namespace RedCrown;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    const BASE_DIR = 'uploads/';
    protected $guarded = ['id'];

    public function getSrcAttribute()
    {
        return self::BASE_DIR . $this->path;
    }

    public function getAltAttribute()
    {
        return $this->filename;
    }
}
