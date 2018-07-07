<?php

namespace common\helpers;


class RandomProperties
{

    /**
     * @return string
     */
    public static function getRandColor()
    {
        return sprintf( '#%02X%02X%02X', rand(0, 255), rand(0, 255), rand(0, 255) );
    }

}