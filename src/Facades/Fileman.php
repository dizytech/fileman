<?php

namespace Dizytech\Fileman\Facades;

use GuzzleHttp\Client;

class Fileman
{
    static public function auth($config = [])
    {
        $login = new Client;
        if(count($config) != 0){
            $login = $login->post(config('fileman.fileman_host')."/api/login",[
                'json' => [
                    'email' => $config['email'],
                    'password' => $config['password'],
                ]
            ]);    
        } else {
            $login = $login->post(config('fileman.fileman_host')."/api/login",[
                'json' => [
                    'email' => config('fileman.fileman_email'),
                    'password' => config('fileman.fileman_password'),
                ]
            ]);  
        }
        $login = json_decode($login->getBody());
        session()->put('fileman_token', $login->access_token);
        return $login->success;
    }
}
