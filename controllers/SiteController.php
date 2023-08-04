<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\Controller;


/**
 * class SiteController
 * 
 * @author KC Samm <kcsamm@studioeternal.net>
 * @package App\Controllers
 */

class SiteController extends Controller
{
    public function home()
    {
        # pass data to home view
        $params = [
            "name" => "KC Samm"
        ];
        return $this->render('home', $params);
    }

    public function contact()
    {
        return $this->render('contact');
    }

    public function handleContact(Request $request)
    {
        $body = $request->getBody();
        echo "<pre>";
        var_dump($body);
        echo "<pre>";
        return "Handling submitted data";
    }
}