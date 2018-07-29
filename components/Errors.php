<?php
namespace components;

class Errors
{
    public static function checkErrors($errors)
    {
        $flag = false;
        $tmp = [];

        foreach ($errors as $error) {
            if ($error !== NULL){
                $flag = true;
                $tmp[] = $error;
            }
        }

        if ($flag) {
            return $tmp;
        } else {
            return [];
        }
    }
}