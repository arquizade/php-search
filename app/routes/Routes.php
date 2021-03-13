<?php

    Route::set('index.php',function(){
        Index::View('Index');
        Index::testdb();
    });
    
?>