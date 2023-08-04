<?php
declare(strict_types=1);

namespace App\Core;

/**
 * class Request
 * 
 * @author KC Samm <kcsamm11@studioeternal.net>
 * @package App\Core
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

    public function getBody()
    {
        $body = [];

        if ($this->getMethod() === 'get')
        {
            foreach($_GET as $key => $value)
            {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($this->getMethod() === 'post')
        {
            foreach($_POST as $key => $value)
            {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $body;
    }
 }