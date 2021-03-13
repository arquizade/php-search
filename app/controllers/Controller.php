<?php

    class Controller extends Database {

        public static function View($view_name){
            include_once('./app/views/'.$view_name.'.php');
        }
    }
?>