<?php

namespace Classes;

class Session
{
    // sukuriamas sesijos kintamasis
    public static function set($type, $message)
    {
        $_SESSION[$type] = $message;
    }
    
    // sunaikinamas sesijos kintamasis
    public static function unset($type)
    {
        unset($_SESSION[$type]);
    }
}
