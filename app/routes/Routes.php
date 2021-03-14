<?php

    Route::set('index.php',function(){
        Root::function_one();
    });

    Route::set('check-location',function(){
        Location::validate_location();
    });

    Route::set('property-list',function(){
        Location::property_list();
    });
    
?>