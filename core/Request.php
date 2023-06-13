<?php
declare(strict_types=1);

namespace app\core;

/**
 * class Request
 * 
 * @author KC Samm <kcsamm11@studioeternal.net>
 * @package app\core
 */

 class Request 
 {
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';

        # Return the psition of '?' in the path variable if 
        # query string exists in $path
        $position = strpos($path, '?');

        if ($position === false) 
        {
            return $path;
        }

        return substr($path, 0, $position);

    }

    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
 }