<?php

class Location extends Controller {

    public static function validate_location(){
        static::model('location_model');
        if(isset($_POST['location']) && !empty($_POST['location'])){
            $qdata = location_model::search_location_name($_POST['location']);
            if(!empty($qdata)){
                $_SESSION['location_id'] = $qdata[0]['__pk'];
                $_SESSION['checkin'] = date('Y-m-d', strtotime($_POST['checkin']));
                $_SESSION['checkout'] = date('Y-m-d', strtotime($_POST['checkout']));

                header('Location: property-list?page=1');
            }else{
                $data['error_message'] = "Sorry we can't find the location.";
                static::view('root_view',$data);
            }
        }else{
            $data['error_message'] = 'You enter invalid location.';
            static::view('root_view',$data);
        }
    }

    public static function property_list(){
        static::model('location_model');
        $no_of_records_per_page = 2;
        $location =  $_SESSION['location_id'];
        $sdate = $_SESSION['checkin'];
        $edate = $_SESSION['checkout'];
        $page = ($_GET['page'] - 1) * $no_of_records_per_page;
        $property_list = location_model::fetch_properties($location,$sdate,$edate,$page,$no_of_records_per_page);

        // print_r($property_list); exit();

        $tbody = array(); $result_count = 0;
        if(!empty($property_list)){
            $result_count = ceil(location_model::get_total_properties($location)[0][0] / $no_of_records_per_page);

            $duplicate = array();
            foreach ($property_list as $value) {

                $status = "Available";
                if($value['status'] == 1){
                    $status = "Not Available";
                }

                $pet_stat = "&#10004;";
                if($value['accepts_pets'] == 0){
                    $pet_stat = "&#x2716;";
                }

                $beach_stat = "&#10004;";
                if($value['near_beach'] == 0){
                    $beach_stat = "&#x2716;";
                }

                $tbody[] = array(
                    'uid'       => $value['id'],
                    'name'      => $value['property_name'],
                    'pet_stat'  => $pet_stat,
                    'beach_stat'=> $beach_stat,
                    'sleeps'    => $value['sleeps'],
                    'beds'      => $value['beds'],
                    'status'    => $status
                );
            }
        }
        $data['tbody'] = $tbody;
        $data['page_count'] = $result_count;
        static::view('property_view',$data);
    }
}