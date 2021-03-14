<?php

    class Controller {

        public static function view($view,$array_variable=null){
            if(!empty($array_variable)){
                extract($array_variable, EXTR_PREFIX_SAME,"wddx");
            }
            include_once('./app/views/'.$view.'.php');
        }

        public static function model($model){
            if (file_exists('./app/models/'.$model.'.php')){
                require_once('./app/models/'.$model.'.php');
            }
        }

    }
?>