<?php
    class Database {
    
        public static $host = "127.0.0.1";
        public static $dbname = "app_db";
        public static $username = "root";
        public static $password = "password";

        private static function connection() {

            $pdo = new PDO('mysql:host='.self::$host.';dbname='.self::$dbname.';charset=utf8', self::$username, self::$password);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }

        public static function query($query, $params = array()) 
        {
            try
            {
                $query_action = explode(' ',$query)[0];
                $statement = self::connection()->prepare($query);
                $statement->execute($params);
                if($query_action=='SELECT')
                {
                    $data = $statement->fetchAll();
                    return $data;
                }elseif($query_action=='INSERT')
                {
                    $id = self::connection()->lastInsertId();
                    return $id;
                }
                else
                {
                    return true;
                }
            }
            catch(PDOException $e){
                // $err_msg = "The user could not be added.<br>".$e->getMessage();
                // return $err_msg;
                return false;
            }
        }
    }
?>