<?php

class DB
{
    public static function connect()
    {
        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $base = 'campsoft';

        return new PDO("mysql:host={$host};dbname={$base};charset=UTF8;", $user, $pass);
    }
}