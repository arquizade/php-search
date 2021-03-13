<?php

    // Set global error capturing
    set_error_handler(function(int $number, string $message) {
        echo "Handler captured error $number: '$message'" . PHP_EOL  ;
    });
    
    // Execute route and class
    try {
        spl_autoload_register(function ($class_name) {
            if(file_exists('./app/classes/'.$class_name.'.php')){
                require_once './app/classes/'.$class_name.'.php';
            } else if (file_exists('./app/controllers/'.$class_name.'.php')){
                require_once './app/controllers/'.$class_name.'.php';
            }
        });
        
        require_once('./app/routes/Routes.php');

    } catch (Throwable $e) {
        echo "Captured Throwable: " . $e->getMessage() . PHP_EOL;
    }

?>