<?php


namespace App\Http\Controllers;


use Oneago\Arcturus\Core\Http\ViewResponse;

class NotFoundController
{
    public function index(): ViewResponse
    {
        return template("NotFound", [
            "title" => "404"
        ]);
    }
}