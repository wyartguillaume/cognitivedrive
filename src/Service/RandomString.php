<?php

namespace App\Service;

class RandomString{
    public static function Generate($nom, $prenom, $length = 20){
        $characters = "azertyuiopqsdfghjklmwxcvbn0789456123AZERTYUIOPQSDFGHJKLMWXCVBN";
        $characterLength = \strlen($characters);
        $randomString = "";
        for($i = 0; $i<$length; $i++){
            $randomString .= $characters[mt_rand(0, $characterLength-1)];
        }
        $randomString .= strval($nom);
        $randomString .= strval($prenom); //sert avoir des token différent
        return $randomString;
    }
}