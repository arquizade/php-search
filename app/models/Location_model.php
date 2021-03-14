<?php

    class Location_Model extends Database {

        public static function search_location_name($keyword){
            return self::query("SELECT * FROM locations WHERE location_name LIKE '%$keyword%'");
        }

        public static function fetch_properties($id,$offset=null,$no_of_records_per_page=null){
            $query = "SELECT A.__pk AS id,A.property_name,A.near_beach,A.accepts_pets,A.sleeps,A.beds,B.start_date,B.end_date FROM properties A LEFT JOIN bookings B ON A.__pk = B._fk_property WHERE A._fk_location = $id";
            if($offset !== null)
                $query .= " LIMIT ".$offset;
            if($no_of_records_per_page !== null)
                $query .= ", ".$no_of_records_per_page;
            return self::query($query);
        }

        public static function get_total_properties($id){
            return self::query("SELECT COUNT(DISTINCT A.__pk) AS result FROM properties A LEFT JOIN bookings B ON A.__pk = B._fk_property WHERE A._fk_location = $id");

        }
    }

?>