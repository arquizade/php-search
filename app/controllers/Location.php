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
        $page = ($_GET['page'] - 1) * $no_of_records_per_page;
        $property_list = location_model::fetch_properties($location,$page,$no_of_records_per_page);

        $tbody = array(); $result_count = 0;
        if(!empty($property_list)){
            $result_count = ceil(location_model::get_total_properties($location)[0][0] / $no_of_records_per_page);
            $sdate = $_SESSION['checkin'];
            $edate = $_SESSION['checkout'];

            $duplicate = array();
            foreach ($property_list as $value) {
                
                if(!empty($value['start_date'])){
                    $stat = 'Available';
                    if(($sdate >= $value['start_date']) && ($sdate <= $value['end_date'])){
                        $stat = 'Not Available';
                    }
                    if(($edate >= $value['start_date']) && ($edate <= $value['end_date'])){
                        $stat = 'Not Available';
                    }
                }else{
                    $stat = 'Available';
                }

                $pet_stat = "&#10004;";
                if($value['accepts_pets'] == 0){
                    $pet_stat = "&#x2716;";
                }

                $beach_stat = "&#10004;";
                if($value['near_beach'] == 0){
                    $beach_stat = "&#x2716;";
                }

                $key = array_search($value['id'],$duplicate);

                if($key === FALSE){
                    $duplicate[] = $value['id'];
                    $tbody[] = array(
                        'uid'       => $value['id'],
                        'name'      => $value['property_name'],
                        'pet_stat'  => $pet_stat,
                        'beach_stat'=> $beach_stat,
                        'sleeps'    => $value['sleeps'],
                        'beds'      => $value['beds'],
                        'status'    => $stat
                    );
                }else{
                    if($stat == 'Not Available')
                        $tbody[$key]['status'] = $stat;
                }
            }
        }
        $data['tbody'] = $tbody;
        $data['page_count'] = $result_count;
        static::view('property_view',$data);
    }
}