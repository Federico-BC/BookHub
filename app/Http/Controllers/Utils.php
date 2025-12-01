<?php

class Utils
{
    public static function generateMainViewTemplateVariables(&$globalData) {
        
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $globalData = [];

        if (isset($_SESSION["username"])) {
            $globalData["username"] = $_SESSION["username"];
        }
    }
}