<?php

    // Set global error capturing
    set_error_handler(function(int $number, string $message) {
        echo "Handler captured error $number: '$message'" . PHP_EOL  ;
    });
    
    // Execute routing and class
    try {
        spl_autoload_register(function ($class_name) {
            if(file_exists('./classes/'.$class_name.'.php')){
                require_once './classes/'.$class_name.'.php';
            } else if (file_exists('./Controller/'.$class_name.'.php')){
                require_once './Controller/'.$class_name.'.php';
            }
        });
        
        require_once('Routes.php');

    } catch (Throwable $e) {
        echo "Captured Throwable: " . $e->getMessage() . PHP_EOL;
    }

?>