<?php

    class Index extends Controller {

        public static function testdb() {
            print_r(self::query('SELECT * FROM users'));
        }

    }

?>