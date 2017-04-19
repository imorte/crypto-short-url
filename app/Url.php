<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Url
 * @package App
 */
class Url extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @param $url
     * @return string
     */
    public function setUrlAttribute($url)
    {
        $protocol = '';
        if(!preg_match('/^(http|https):\/\//', $url)) {
            $protocol = 'http://';
        }

        $this->attributes['url'] = $protocol . $url;
    }
}
