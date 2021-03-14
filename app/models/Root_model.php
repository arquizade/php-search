<?php

    class Root_Model extends Database {

        public static function testdb(){
            return self::query('SELECT * FROM locations');
        }
    }
?>