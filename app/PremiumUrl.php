<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PremiumUrl
 * @package App
 */
class PremiumUrl extends Model
{
    /**
     * @param $url
     * @return string
     */
    public function getUrlAttribute($url)
    {
        $protocol = '';

        if(!preg_match('/^(http|https):\/\//', $url)) {
            $protocol = 'http://';
        }

        return $protocol . $url;
    }
}
