<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rejection_rate extends CI_Controller {

	public function __construct() {
			
		parent::__construct();
		$this->load->helper('browser');
		$this->load->helper('cookies');
		$data_cookies = helper_cookies(@$this->input->get('user'));

		$this->load->model('home_mod');
		$this->load->model('general_mod');
		$this->load->model('engineering_mod');
		$this->load->model('fitup_mod');
		$this->load->model('visual_mod');
		$this->load->model('planning_mod');
		$this->load->model('wtr_mod');
		$this->load->model('rejection_rate_mod');

		$this->user_cookie 		  = $data_cookies['data_user'];
		$this->permission_cookie  = $data_cookies['data_permission'];
    $this->sidebar 	= "rejection_rate/sidebar";
    $this->is_admin           = $this->permission_cookie[0];
    $this->project_alt        = $this->user_cookie[13];
    $this->company_alt        = $this->user_cookie[14];
	}

	public function index(){
	   redirect('rejection_rate/rate_weekly');	 	
	}

    public function rate_index($type = null ,$type_of_module = null , $discipline = null){

            error_reporting(0);

            $type = $this->encryption->decrypt(strtr($type, '.-~', '+=/'));      

            if($type == "cmltv"){
                $data["title_menu"]     = "Comulative Data - Rejection Rate";
                $data["title_code"]     = "cmltv";
                $data["chart_code"]     = "Overall Comulative";
            } else if($type == "ts"){
                $data["title_menu"]     = "Top Side - Rejection Rate";
                $data["title_code"]     = "ts";
                $data["chart_code"]     = "Top Side";
            } else if($type == "jkt"){
                $data["title_menu"]     = "Jacket - Rejection Rate";
                $data["title_code"]     = "jkt";
                $data["chart_code"]     = "Jacket";
            } else if($type == "str"){
                $data["title_menu"]     = "Structural - Rejection Rate";
                $data["title_code"]     = "str";
                $data["chart_code"]     = "Structural";
            } else if($type == "pip"){
                $data["title_menu"]     = "Piping - Rejection Rate";
                $data["title_code"]     = "pip";
                $data["chart_code"]     = "Piping";
            } else {
                $data["title_menu"]     = "Comulative Data - Rejection Rate";
                $data["title_code"]     = "cmltv";
                $data["chart_code"]     = "Overall Comulative";
            }
            

        // ------------------ //

        $period = new DatePeriod(
            new DateTime('2021-10-25'),
            new DateInterval('P1D'),
            new DateTime(date("Y-m-d"))
        );

        foreach ($period as $key => $value) {         
           $grouping_week[] = ($value->format('W-Y') == "52-2022" ? "51-2021" : $value->format('W-Y'));   
        }

        $get_unique_week = array_unique($grouping_week);
        

        function getStartAndEndDate($year_week) {
            $week = substr($year_week,0,2);
            $year = substr($year_week,-4);
            $dto = new DateTime();
            $dto->setISODate($year, $week);
            $ret['week_start'] = $dto->format('Y-m-d');
            $dto->modify('+7 days');
            $ret['week_end'] = $dto->format('Y-m-d');            
            return $ret;
        }
      
        function getRangedate($start, $end) {
            $period = new DatePeriod(
                new DateTime($start),
                new DateInterval('P1D'),
                new DateTime($end)
            );
            $array_populated = array();
            foreach ($period as $key => $value) {
                $array_populated[] = $value->format('Y-m-d');
            }
            return $array_populated;
        }

        $data_array_date = [];
        foreach($get_unique_week as $key => $value){            
            $week_no = getStartAndEndDate($value);
            $data_array_date[] = array_reverse(getRangedate($week_no["week_start"], $week_no["week_end"]));            
            $data_array_date_x[date("W-Y",strtotime($week_no["week_start"]))] = array_reverse(getRangedate($week_no["week_start"], $week_no["week_end"]));            
        }
  
         //test_var($data_array_date_x,1);

        $start_end_filter = $data_array_date;
        $start_date_group = $start_end_filter[0][6];
        $end_date_group   = $start_end_filter[max(array_keys($data_array_date))][0];   
         
        // ------------------ //
        
        if(isset($type_of_module) && !empty($type_of_module)){
            $type_of_module = $this->encryption->decrypt(strtr($type_of_module, '.-~', '+=/'));      
            if($type_of_module != "x"){      
             $where["a.type_of_module"]  = $type_of_module;
            }
        }

        if(isset($discipline) && !empty($discipline)){
            $discipline 	= $this->encryption->decrypt(strtr($discipline, '.-~', '+=/'));
            if($discipline != "x"){      
                $where["a.discipline"]  = $discipline;
            }
        }

        $data['id_deck_list'] = [5,6,7,8,9,10]; 
        $where["date(a.weld_datetime) BETWEEN '". $start_date_group."' AND '".$end_date_group."'"]  = null;
        $where["a.revision IS NULL AND a.revision_category IS NULL"]   = null;
        $where["c.deck_elevation IN(".join(", ", $data['id_deck_list']).")"]   = null;  
        $where["c.project"]   = $this->user_cookie[10]; 
        $where["d.ndt_type IN (1,3)"]           = null;
        $where["d.result IN (2,3)"]           = null;
        $data['visual_data'] = $this->rejection_rate_mod->get_visual_data($where);   
        unset($where); 

        if(sizeof($data['visual_data']) > 0){
            $get_data_ndt= array_column($data['visual_data'], 'id_visual');
            $where_ndt["a.id_visual IN ('".implode("', '", $get_data_ndt)."')"] = NULL;
            $data['ndt_data'] = $this->rejection_rate_mod->get_ndt_data($where_ndt);
            unset($where_ndt); 
        } else {
            $data['ndt_data'] = null;
        }
        
        $data_reject = array();       
        foreach($data['ndt_data'] as $key => $value){
            $data_reject[$value['id_visual']] += $value['length'];
        }

       
        $count        = [];
        $array_process_length = array();
        foreach($data['visual_data'] as $key => $value){

            $process_gtaw_rh = (isset($value['process_gtaw_rh']) ? $value['process_gtaw_rh'] : 0);   
            $process_gmaw_rh = (isset($value['process_gmaw_rh']) ? $value['process_gmaw_rh'] : 0);   
            $process_smaw_rh = (isset($value['process_smaw_rh']) ? $value['process_smaw_rh'] : 0);   
            $process_fcaw_rh = (isset($value['process_fcaw_rh']) ? $value['process_fcaw_rh'] : 0);   
            $process_saw_rh  = (isset($value['process_saw_rh'])  ? $value['process_saw_rh'] : 0);  

            $process_gtaw_fc = (isset($value['process_gtaw_fc']) ? $value['process_gtaw_fc'] : 0);   
            $process_gmaw_fc = (isset($value['process_gmaw_fc']) ? $value['process_gmaw_fc'] : 0);   
            $process_smaw_fc = (isset($value['process_smaw_fc']) ? $value['process_smaw_fc'] : 0);   
            $process_fcaw_fc = (isset($value['process_fcaw_fc']) ? $value['process_fcaw_fc'] : 0);   
            $process_saw_fc  = (isset($value['process_saw_fc'])  ? $value['process_saw_fc'] : 0);
            
            $joint_gtaw = $process_gtaw_rh.";".$process_gtaw_fc;
            $joint_gmaw = $process_gmaw_rh.";".$process_gmaw_fc;
            $joint_smaw = $process_smaw_rh.";".$process_smaw_fc;
            $joint_fcaw = $process_fcaw_rh.";".$process_fcaw_fc;
            $joint_saw  = $process_saw_rh.";".$process_gtaw_fc;

            $array_gtaw = explode(";",$joint_gtaw);
            $array_gmaw = explode(";",$joint_gmaw);
            $array_smaw = explode(";",$joint_smaw );
            $array_fcaw = explode(";",$joint_fcaw);
            $array_saw  = explode(";",$joint_saw);

            $process_gtaw = (in_array("1", $array_gtaw) == true ? "1" : "0");
            $process_gmaw = (in_array("1", $array_gmaw) == true ? "1" : "0");
            $process_smaw = (in_array("1", $array_smaw) == true ? "1" : "0");
            $process_fcaw = (in_array("1", $array_fcaw) == true ? "1" : "0");
            $process_saw  = (in_array("1", $array_saw) == true ? "1" : "0");
            

            $total_process    = $process_gtaw + $process_gmaw + $process_smaw + $process_fcaw + $process_saw;

            $total_process_rh = $process_gtaw_rh + $process_gmaw_rh + $process_smaw_rh + $process_fcaw_rh + $process_saw_rh;
            $total_process_fc = $process_gtaw_fc + $process_gmaw_fc + $process_smaw_fc + $process_fcaw_fc + $process_saw_fc;

            $array_process_length[] = array(

                "id_visual"              => $value['id_visual'],

                "tested_length_gtaw"     => ( $process_gtaw == 1 ? round($value['tested_length'] / $total_process,2) : 0),
                "tested_length_smaw"     => ( $process_smaw == 1 ? round($value['tested_length'] / $total_process,2) : 0),
                "tested_length_fcaw"     => ( $process_fcaw == 1 ? round($value['tested_length'] / $total_process,2) : 0),
                "tested_length_saw"      => ( $process_saw  == 1 ? round($value['tested_length'] / $total_process,2) : 0),
                "tested_length_gmaw"     => ( $process_gmaw == 1 ? round($value['tested_length'] / $total_process,2) : 0),

                "reject_length_gtaw"     => ( ($process_gtaw_rh == 1 ? (isset($value['reject_length_rh']) ? round($value['reject_length_rh'] / $total_process_rh,2) : 0 ) : 0) + ($process_gtaw_fc == 1 ? (isset($value['reject_length_fc']) ? round($value['reject_length_fc'] / $total_process_fc) : 0 ) : 0) ),
                "reject_length_smaw"     => ( ($process_smaw_rh == 1 ? (isset($value['reject_length_rh']) ? round($value['reject_length_rh'] / $total_process_rh,2) : 0 ) : 0) + ($process_smaw_fc == 1 ? (isset($value['reject_length_fc']) ? round($value['reject_length_fc'] / $total_process_fc) : 0 ) : 0) ),
                "reject_length_fcaw"     => ( ($process_fcaw_rh == 1 ? (isset($value['reject_length_rh']) ? round($value['reject_length_rh'] / $total_process_rh,2) : 0 ) : 0) + ($process_fcaw_fc == 1 ? (isset($value['reject_length_fc']) ? round($value['reject_length_fc'] / $total_process_fc) : 0 ) : 0) ),
                "reject_length_saw"      => ( ($process_saw_rh  == 1 ? (isset($value['reject_length_rh']) ? round($value['reject_length_rh'] / $total_process_rh,2) : 0 ) : 0) + ($process_saw_fc  == 1 ? (isset($value['reject_length_fc']) ? round($value['reject_length_fc'] / $total_process_fc) : 0 ) : 0) ),
                "reject_length_gmaw"     => ( ($process_gmaw_rh == 1 ? (isset($value['reject_length_rh']) ? round($value['reject_length_rh'] / $total_process_rh,2) : 0 ) : 0) + ($process_gmaw_fc == 1 ? (isset($value['reject_length_fc']) ? round($value['reject_length_fc'] / $total_process_fc) : 0 ) : 0) ),
                
                "total_process_gtaw"     => $process_gtaw,
                "total_process_smaw"     => $process_smaw,
                "total_process_fcaw"     => $process_fcaw,
                "total_process_saw"      => $process_saw,
                "total_process_gmaw"     => $process_gmaw,

                "total_process_overall"  => $total_process,
                "weld_datetime"          => $value['weld_datetime'],
                "week_no"                => date("W-Y",strtotime($value['weld_datetime'])),
                "id_joint"               => $value['id_joint'],
                "ndt_type"               => $value['ndt_initial'],
                "weld_length_overall"    => ($value['re_request'] != 1 ? $value['length_of_weld'] : 0),
                "tested_length_overall"  => $value['tested_length'],

            );

        }

   

    // foreach($array_process_length as $key => $value){
    //     if($value['week_no'] == '43-2021'){
    //         $data_specific_week[] = $value;
    //     }
    // }

    // test_var($data_specific_week,1);

        //--------------- Grouping process Welding ----------------//
          
            $sum_total_tested_automatic_welding_ut      = array();
            $sum_total_tested_manual_welding_ut         = array();
            $sum_total_tested_semi_automatic_welding_ut = array();

            $sum_total_reject_automatic_welding_ut      = array();
            $sum_total_reject_manual_welding_ut         = array();
            $sum_total_reject_semi_automatic_welding_ut = array();

            $sum_total_joint_automatic_welding_ut       = array();
            $sum_total_joint_manual_welding_ut          = array();
            $sum_total_joint_semi_automatic_welding_ut  = array();

            $sum_total_tested_automatic_welding_rt      = array();
            $sum_total_tested_manual_welding_rt         = array();
            $sum_total_tested_semi_automatic_welding_rt = array();

            $sum_total_reject_automatic_welding_rt      = array();
            $sum_total_reject_manual_welding_rt         = array();
            $sum_total_reject_semi_automatic_welding_rt = array();

            $sum_total_joint_automatic_welding_rt       = array();
            $sum_total_joint_manual_welding_rt          = array();
            $sum_total_joint_semi_automatic_welding_rt  = array();
            
            foreach($array_process_length as $key => $value){
                           
                if($value["ndt_type"] == 'UT'){

                    // tested length //
                 
                    if(!isSet($sum_total_tested_automatic_welding_ut["UT"][$value["week_no"]])) {
                        $sum_total_tested_automatic_welding_ut["UT"][$value["week_no"]] = 0;
                    }
                    $sum_total_tested_automatic_welding_ut["UT"][$value["week_no"]] += $value["tested_length_saw"];

                    if(!isSet($sum_total_tested_manual_welding_ut["UT"][$value["week_no"]])) {
                        $sum_total_tested_manual_welding_ut["UT"][$value["week_no"]] = 0;
                    }
                    $sum_total_tested_manual_welding_ut["UT"][$value["week_no"]] += ($value["tested_length_gtaw"] + $value["tested_length_smaw"]);

                    if(!isSet($sum_total_tested_semi_automatic_welding_ut["UT"][$value["week_no"]])) {
                        $sum_total_tested_semi_automatic_welding_ut["UT"][$value["week_no"]] = 0;
                    }
                    $sum_total_tested_semi_automatic_welding_ut["UT"][$value["week_no"]] += ($value['tested_length_fcaw'] + $value['reject_length_gmaw']);

                    // tested length //

                    // reject length //

                    if(!isSet($sum_total_reject_automatic_welding_ut["UT"][$value["week_no"]])) {
                        $sum_total_reject_automatic_welding_ut["UT"][$value["week_no"]] = 0;
                    }
                    $sum_total_reject_automatic_welding_ut["UT"][$value["week_no"]] += $value["reject_length_saw"];

                    if(!isSet($sum_total_reject_manual_welding_ut["UT"][$value["week_no"]])) {
                        $sum_total_reject_manual_welding_ut["UT"][$value["week_no"]] = 0;
                    }
                    $sum_total_reject_manual_welding_ut["UT"][$value["week_no"]] += ($value["reject_length_gtaw"] + $value["reject_length_smaw"]);

                    if(!isSet($sum_total_reject_semi_automatic_welding_ut["UT"][$value["week_no"]])) {
                        $sum_total_reject_semi_automatic_welding_ut["UT"][$value["week_no"]] = 0;
                    }
                    $sum_total_reject_semi_automatic_welding_ut["UT"][$value["week_no"]] += ($value["reject_length_fcaw"] + $value["reject_length_gmaw"]);
                   
                    // reject length //

                    // Total Joint //

                    if(!isSet($sum_total_joint_automatic_welding_ut["UT"][$value["week_no"]])) {
                        $sum_total_joint_automatic_welding_ut["UT"][$value["week_no"]] = 0;
                    }
                    $sum_total_joint_automatic_welding_ut["UT"][$value["week_no"]] += $value["total_joint_saw"];

                    if(!isSet($sum_total_joint_manual_welding_ut["UT"][$value["week_no"]])) {
                        $sum_total_joint_manual_welding_ut["UT"][$value["week_no"]] = 0;
                    }
                    $sum_total_joint_manual_welding_ut["UT"][$value["week_no"]] += ($value["total_process_gtaw"] + $value["total_process_smaw"]);

                    if(!isSet($sum_total_joint_semi_automatic_welding_ut["UT"][$value["week_no"]])) {
                        $sum_total_joint_semi_automatic_welding_ut["UT"][$value["week_no"]] = 0;
                    }
                    $sum_total_joint_semi_automatic_welding_ut["UT"][$value["week_no"]] += ($value["total_process_fcaw"] + $value["tested_length_gmaw"]);
                   
                   // Total Joint //

                }
                

                if($value["ndt_type"] == 'RT'){

                    // tested length //
                    
                    if(!isSet($sum_total_tested_automatic_welding_rt["RT"][$value["week_no"]])) {
                        $sum_total_tested_automatic_welding_rt["RT"][$value["week_no"]] = 0;
                    }
                    $sum_total_tested_automatic_welding_rt["RT"][$value["week_no"]] += $value["tested_length_saw"];
                    
                    if(!isSet($sum_total_tested_manual_welding_rt["RT"][$value["week_no"]])) {
                        $sum_total_tested_manual_welding_rt["RT"][$value["week_no"]] = 0;
                    }
                    $sum_total_tested_manual_welding_rt["RT"][$value["week_no"]] += ($value["tested_length_gtaw"] + $value["tested_length_smaw"]);
                    
                    if(!isSet($sum_total_tested_semi_automatic_welding_rt["RT"][$value["week_no"]])) {
                        $sum_total_tested_semi_automatic_welding_rt["RT"][$value["week_no"]] = 0;
                    }
                    $sum_total_tested_semi_automatic_welding_rt["RT"][$value["week_no"]] += ($value['tested_length_fcaw'] + $value['reject_length_gmaw']);
                    
                    // tested length //
                    
                    // reject length //
                    
                    if(!isSet($sum_total_reject_automatic_welding_rt["RT"][$value["week_no"]])) {
                        $sum_total_reject_automatic_welding_rt["RT"][$value["week_no"]] = 0;
                    }
                    $sum_total_reject_automatic_welding_rt["RT"][$value["week_no"]] += $value["reject_length_saw"];
                    
                    if(!isSet($sum_total_reject_manual_welding_rt["RT"][$value["week_no"]])) {
                        $sum_total_reject_manual_welding_rt["RT"][$value["week_no"]] = 0;
                    }
                    $sum_total_reject_manual_welding_rt["RT"][$value["week_no"]] += ($value["reject_length_gtaw"] + $value["reject_length_smaw"]);
                    
                    if(!isSet($sum_total_reject_semi_automatic_welding_rt["RT"][$value["week_no"]])) {
                        $sum_total_reject_semi_automatic_welding_rt["RT"][$value["week_no"]] = 0;
                    }
                    $sum_total_reject_semi_automatic_welding_rt["RT"][$value["week_no"]] += ($value["reject_length_fcaw"] + $value["reject_length_gmaw"]);
                    
                    // reject length //
                    
                    // Total Joint //
                    
                    if(!isSet($sum_total_joint_automatic_welding_rt["RT"][$value["week_no"]])) {
                        $sum_total_joint_automatic_welding_rt["RT"][$value["week_no"]] = 0;
                    }
                    $sum_total_joint_automatic_welding_rt["RT"][$value["week_no"]] += $value["total_joint_saw"];
                    
                    if(!isSet($sum_total_joint_manual_welding_rt["RT"][$value["week_no"]])) {
                        $sum_total_joint_manual_welding_rt["RT"][$value["week_no"]] = 0;
                    }
                    $sum_total_joint_manual_welding_rt["RT"][$value["week_no"]] += ($value["total_process_gtaw"] + $value["total_process_smaw"]);
                    
                    if(!isSet($sum_total_joint_semi_automatic_welding_rt["RT"][$value["week_no"]])) {
                        $sum_total_joint_semi_automatic_welding_rt["RT"][$value["week_no"]] = 0;
                    }
                    $sum_total_joint_semi_automatic_welding_rt["RT"][$value["week_no"]] += ($value["total_process_fcaw"] + $value["tested_length_gmaw"]);
                    
                    // Total Joint //
                    
                }


            }
           
            $grouping_data_based_process_UT = array();
            $grouping_data_based_process_RT = array();

            foreach($array_process_length as $key => $value){

                $grouping_data_based_process_UT[$value["week_no"]]["UT"] = array(
                    "total_tested_automatic_welding_ut"       => ($sum_total_tested_automatic_welding_ut["UT"][$value["week_no"]] ? $sum_total_tested_automatic_welding_ut["UT"][$value["week_no"]] : 0),
                    "total_tested_manual_welding_ut"          => ($sum_total_tested_manual_welding_ut["UT"][$value["week_no"]] ? $sum_total_tested_manual_welding_ut["UT"][$value["week_no"]] : 0),
                    "total_tested_semi_automatic_welding_ut"  => ($sum_total_tested_semi_automatic_welding_ut["UT"][$value["week_no"]] ? $sum_total_tested_semi_automatic_welding_ut["UT"][$value["week_no"]] : 0),
                    "total_reject_automatic_welding_ut"       => ($sum_total_reject_automatic_welding_ut["UT"][$value["week_no"]] ? $sum_total_reject_automatic_welding_ut["UT"][$value["week_no"]] : 0),
                    "total_reject_manual_welding_ut"          => ($sum_total_reject_manual_welding_ut["UT"][$value["week_no"]] ? $sum_total_reject_manual_welding_ut["UT"][$value["week_no"]] : 0),
                    "total_reject_semi_automatic_welding_ut"  => ($sum_total_reject_semi_automatic_welding_ut["UT"][$value["week_no"]] ? $sum_total_reject_semi_automatic_welding_ut["UT"][$value["week_no"]] : 0),
                    "total_joint_automatic_welding_ut"        => ($sum_total_joint_automatic_welding_ut["UT"][$value["week_no"]] ? $sum_total_joint_automatic_welding_ut["UT"][$value["week_no"]] : 0),
                    "total_joint_manual_welding_ut"           => ($sum_total_joint_manual_welding_ut["UT"][$value["week_no"]] ? $sum_total_joint_manual_welding_ut["UT"][$value["week_no"]] : 0),
                    "total_joint_semi_automatic_welding_ut"   => ($sum_total_joint_semi_automatic_welding_ut["UT"][$value["week_no"]] ? $sum_total_joint_semi_automatic_welding_ut["UT"][$value["week_no"]] : 0),
                    "ndt_type_ut"                             => "UT",                        
                    "week_no"                                 => $value["week_no"],                
                );

                $grouping_data_based_process_RT[$value["week_no"]]["RT"] = array(
                    "total_tested_automatic_welding_rt"       => ($sum_total_tested_automatic_welding_rt["RT"][$value["week_no"]] ? $sum_total_tested_automatic_welding_rt["RT"][$value["week_no"]] : 0),
                    "total_tested_manual_welding_rt"          => ($sum_total_tested_manual_welding_rt["RT"][$value["week_no"]] ? $sum_total_tested_manual_welding_rt["RT"][$value["week_no"]] : 0),
                    "total_tested_semi_automatic_welding_rt"  => ($sum_total_tested_semi_automatic_welding_rt["RT"][$value["week_no"]] ? $sum_total_tested_semi_automatic_welding_rt["RT"][$value["week_no"]] : 0),
                    "total_reject_automatic_welding_rt"       => ($sum_total_reject_automatic_welding_rt["RT"][$value["week_no"]] ? $sum_total_reject_automatic_welding_rt["RT"][$value["week_no"]] : 0),
                    "total_reject_manual_welding_rt"          => ($sum_total_reject_manual_welding_rt["RT"][$value["week_no"]] ? $sum_total_reject_manual_welding_rt["RT"][$value["week_no"]] : 0),
                    "total_reject_semi_automatic_welding_rt"  => ($sum_total_reject_semi_automatic_welding_rt["RT"][$value["week_no"]] ? $sum_total_reject_semi_automatic_welding_rt["RT"][$value["week_no"]] : 0),
                    "total_joint_automatic_welding_rt"        => ($sum_total_joint_automatic_welding_rt["RT"][$value["week_no"]] ? $sum_total_joint_automatic_welding_rt["RT"][$value["week_no"]] : 0),
                    "total_joint_manual_welding_rt"           => ($sum_total_joint_manual_welding_rt["RT"][$value["week_no"]] ? $sum_total_joint_manual_welding_rt["RT"][$value["week_no"]] : 0),
                    "total_joint_semi_automatic_welding_rt"   => ($sum_total_joint_semi_automatic_welding_rt["RT"][$value["week_no"]] ? $sum_total_joint_semi_automatic_welding_rt["RT"][$value["week_no"]] : 0),
                    "ndt_type_rt"                             => "RT",
                    "week_no"                                 => $value["week_no"],              
                );

            }
         
        //--------------- Grouping process Welding ----------------//

        $data["rejection_rate_ut"] = $grouping_data_based_process_UT;
        $data["rejection_rate_rt"] = $grouping_data_based_process_RT;
        $data["start_cut_off"]     = $start_date_group;
        $data["end_cut_off"]       = $end_date_group;
        $data["looping_week"]      = $data_array_date_x;

        //--------------- link data ----------------//

        $data["type_link"]            = $type;
        $data["type_of_module_link"]  = $type_of_module;
        $data["discipline_link"]      = $discipline;

        //--------------- link data ----------------//

        //test_var($data["rejection_rate_ut"]["45-2021"]["UT"],1);
      
        $data['user_cookie'] 	   = $this->user_cookie;
		$data['user_permission']   = $this->permission_cookie;
		$data['meta_title']   	   = 'Rejection Rate';
		$data['subview']      	   = 'rejection_rate/rejection_rate';
    	$data['sidebar']      	   = $this->sidebar;

		$this->load->view('index', $data);

    }


    public function audit($week = null ,$type = null ,$type_of_module = null , $discipline = null){

        $datadb = $this->general_mod->discipline();
		$discipline_list = [];
		foreach ($datadb as $key => $value) {
			$discipline_list[$value['initial']] = $value;
			$data['discipline_list_data'][$value['id']] = $value;
			$data['discipline_code'][$value['id']] = $value['initial'];
		}
		$data['discipline_list'] = $discipline_list;

        $datadb = $this->visual_mod->master_welder_new();
		foreach ($datadb as $key => $value) {
			$data["master_welder"][$value['id_welder']] = $value;
		}

		$datadb = $this->general_mod->type_of_module();
		$type_of_module_list = [];
		foreach ($datadb as $key => $value) {
			$type_of_module_list[$value['code']] = $value;
			$data['type_of_module_code'][$value['id']] = $value['code'];
		}
		$data['type_of_module_list'] = $type_of_module_list;

		$datadb = $this->general_mod->module();
		$module_list = [];
		foreach ($datadb as $key => $value) {
			$module_list[$value['mod_id']] = $value;
			$data['module_code'][$value['mod_id']] = $value['mod_desc'];
		}
		$data['module_list'] = $module_list;

        $week           = $this->encryption->decrypt(strtr($week, '.-~', '+=/'));      
        $type           = $this->encryption->decrypt(strtr($type, '.-~', '+=/'));      
        $type_of_module = $this->encryption->decrypt(strtr($type_of_module, '.-~', '+=/'));  
        $discipline     = $this->encryption->decrypt(strtr($discipline, '.-~', '+=/'));    

        if($type == "cmltv"){
            $data["title_menu"]     = "Comulative Data - Rejection Rate";
            $data["title_code"]     = "cmltv";
            $data["chart_code"]     = "Overall Comulative";
        } else if($type == "ts"){
            $data["title_menu"]     = "Top Side - Rejection Rate";
            $data["title_code"]     = "ts";
            $data["chart_code"]     = "Top Side";
        } else if($type == "jkt"){
            $data["title_menu"]     = "Jacket - Rejection Rate";
            $data["title_code"]     = "jkt";
            $data["chart_code"]     = "Jacket";
        } else if($type == "str"){
            $data["title_menu"]     = "Structural - Rejection Rate";
            $data["title_code"]     = "str";
            $data["chart_code"]     = "Structural";
        } else if($type == "pip"){
            $data["title_menu"]     = "Piping - Rejection Rate";
            $data["title_code"]     = "pip";
            $data["chart_code"]     = "Piping";
        } else {
            $data["title_menu"]     = "Comulative Data - Rejection Rate";
            $data["title_code"]     = "cmltv";
            $data["chart_code"]     = "Overall Comulative";
        }

        // ------- Date Populated ----------//


        $period = new DatePeriod(
            new DateTime('2021-10-15'),
            new DateInterval('P1D'),
            new DateTime(date("Y-m-d"))
        );

        foreach ($period as $key => $value) {         
           $grouping_week[] = ($value->format('W-Y') == "52-2022" ? "51-2021" : $value->format('W-Y'));   
        }

        $get_unique_week = array_unique($grouping_week);
        

        function getStartAndEndDate($year_week) {
            $week = substr($year_week,0,2);
            $year = substr($year_week,-4);
            $dto = new DateTime();
            $dto->setISODate($year, $week);
            $ret['week_start'] = $dto->format('Y-m-d');
            $dto->modify('+7 days');
            $ret['week_end'] = $dto->format('Y-m-d');            
            return $ret;
        }
      
        function getRangedate($start, $end) {
            $period = new DatePeriod(
                new DateTime($start),
                new DateInterval('P1D'),
                new DateTime($end)
            );
            $array_populated = array();
            foreach ($period as $key => $value) {
                $array_populated[] = $value->format('Y-m-d');
            }
            return $array_populated;
        }

        $data_array_date = [];
        foreach($get_unique_week as $key => $value){            
            $week_no = getStartAndEndDate($value);
            $data_array_date[] = array_reverse(getRangedate($week_no["week_start"], $week_no["week_end"]));            
            $data_array_date_x[date("W-Y",strtotime($week_no["week_start"]))] = array_reverse(getRangedate($week_no["week_start"], $week_no["week_end"]));            
        }
  
        $selected_week = array();
        foreach($data_array_date_x as $key => $value){
            if($key == $week){
                $selected_week[] = $value;
            }
        }

        $start_date_group = $selected_week[0][6];
        $end_date_group   = $selected_week[max(array_keys($selected_week))][0];  


        // ------- Date Populated ----------//

        // ------- Get Data Visual----------//

        if(isset($type_of_module) && !empty($type_of_module)){
            $type_of_module = $this->encryption->decrypt(strtr($type_of_module, '.-~', '+=/'));      
            if($type_of_module != "x"){      
             $where["a.type_of_module"]  = $type_of_module;
            }
        }

        if(isset($discipline) && !empty($discipline)){
            $discipline 	= $this->encryption->decrypt(strtr($discipline, '.-~', '+=/'));
            if($discipline != "x"){      
                $where["a.discipline"]  = $discipline;
            }
        }

        $data['id_deck_list'] = [5,6,7,8,9,10]; 
        $where["date(a.weld_datetime) BETWEEN '". $start_date_group."' AND '".$end_date_group."'"]  = null;
        $where["a.revision IS NULL AND a.revision_category IS NULL"]   = null;
        $where["c.deck_elevation IN(".join(", ", $data['id_deck_list']).")"]   = null;  
        $where["c.project"]   = $this->user_cookie[10]; 
        $where["d.ndt_type IN (1,3)"]           = null;
        $where["d.result IN (2,3)"]           = null;
        $data['visual_data'] = $this->rejection_rate_mod->get_visual_data($where);       
        unset($where); 

      

       // test_var($data['visual_data'],1);
        
      // ------- Get Data Visual----------//

      $data["start_cut_off"]     = $start_date_group;
      $data["end_cut_off"]       = $end_date_group;

      $data["week_date"]         =  $week;

      $data['user_cookie'] 	       = $this->user_cookie;
      $data['user_permission']     = $this->permission_cookie;
      $data['meta_title']   	   = 'Rejection Rate';
      $data['subview']      	   = 'rejection_rate/data_audit';
      $data['sidebar']      	   = $this->sidebar;

      $this->load->view('index', $data);

      
                   

    }

    public function rate_weekly($type = null ,$type_of_module = null , $discipline = null, $project = null){

        error_reporting(0);

        $type       = $this->encryption->decrypt(strtr($type, '.-~', '+=/'));      
        $project    = $this->encryption->decrypt(strtr($project, '.-~', '+=/'));  

        if($type == "cmltv"){
            $data["title_menu"]     = "Comulative Data - Rejection Rate";
            $data["title_code"]     = "cmltv";
            $data["chart_code"]     = "Overall Comulative";
        } else if($type == "ts"){
            $data["title_menu"]     = "Top Side - Rejection Rate";
            $data["title_code"]     = "ts";
            $data["chart_code"]     = "Top Side";
        } else if($type == "jkt"){
            $data["title_menu"]     = "Jacket - Rejection Rate";
            $data["title_code"]     = "jkt";
            $data["chart_code"]     = "Jacket";
        } else if($type == "str"){
            $data["title_menu"]     = "Structural - Rejection Rate";
            $data["title_code"]     = "str";
            $data["chart_code"]     = "Structural";
        } else if($type == "pip"){
            $data["title_menu"]     = "Piping - Rejection Rate";
            $data["title_code"]     = "pip";
            $data["chart_code"]     = "Piping";
        } else {
            $data["title_menu"]     = "Comulative Data - Rejection Rate";
            $data["title_code"]     = "cmltv";
            $data["chart_code"]     = "Overall Comulative";
        }
        

    // ------------------ //

    $period = new DatePeriod(
        new DateTime('2022-12-06'),
        new DateInterval('P1D'),
        new DateTime(date("Y-m-d"))
    );

    foreach ($period as $key => $value) {         
       $grouping_week[] = ($value->format('W-Y') == "52-2023" ? "51-2022" : $value->format('W-Y'));   
    }

    $get_unique_week = array_unique($grouping_week); 

    function getStartAndEndDate($year_week) {
        $week = substr($year_week,0,2);
        $year = substr($year_week,-4);
        $dto = new DateTime();
        $dto->setISODate($year, $week);
        $ret['week_start'] = $dto->format('Y-m-d');
        $dto->modify('+7 days');
        $ret['week_end'] = $dto->format('Y-m-d');            
        return $ret;
    }
  
    function getRangedate($start, $end) {
        $period = new DatePeriod(
            new DateTime($start),
            new DateInterval('P1D'),
            new DateTime($end)
        );
        $array_populated = array();
        foreach ($period as $key => $value) {
            $array_populated[] = $value->format('Y-m-d');
        }
        return $array_populated;
    }

    $data_array_date = [];
    foreach($get_unique_week as $key => $value){            
        $week_no = getStartAndEndDate($value);
        $data_array_date[] = array_reverse(getRangedate($week_no["week_start"], $week_no["week_end"]));            
        $data_array_date_x[date("W-Y",strtotime($week_no["week_start"]))] = array_reverse(getRangedate($week_no["week_start"], $week_no["week_end"]));            
    } 

    $start_end_filter = $data_array_date;
    $start_date_group = $start_end_filter[0][6];
    $end_date_group   = $start_end_filter[max(array_keys($data_array_date))][0];   
     
    // ------------------ //
    
    if(isset($type_of_module) && !empty($type_of_module)){
        $type_of_module = $this->encryption->decrypt(strtr($type_of_module, '.-~', '+=/'));      
        if($type_of_module != "x"){      
         $where["a.type_of_module"]  = $type_of_module;
        }
    }

    if(isset($discipline) && !empty($discipline)){
        $discipline 	= $this->encryption->decrypt(strtr($discipline, '.-~', '+=/'));
        if($discipline != "x"){      
            $where["a.discipline"]  = $discipline;
        }
    }

    $data['id_deck_list'] = [5,6,7,8,9,10,17];  

    $where["date(d.tested_date) BETWEEN '". $start_date_group."' AND '".$end_date_group."'"]  = null;  
    $where["a.revision IS NULL AND a.revision_category IS NULL"]   = null;
    if(!$this->is_admin) {
      $where[implode_where('c.project', $this->project_alt)] = null;
    }
    $where["c.deck_elevation IN(".join(", ", $data['id_deck_list']).")"]   = null;  
    $where["d.result IN (0,2,3)"]           = null;   
    $data['visual_data'] = $this->rejection_rate_mod->get_visual_data_new_v21($where);   
    unset($where); 
     

    if(sizeof($data['visual_data']) > 0){
    
        $where["b.result"]   = 2; 
        $where["b.ndt_type"] = 3; 
        $id_joint_vs   = array_unique(array_column($data['visual_data'],'id_joint')); 
        $where["d.id IN ('".implode("', '", $id_joint_vs)."')"] = NULL;  
        if(isset($type_of_module) && !empty($type_of_module)){
            $type_of_module = $this->encryption->decrypt(strtr($type_of_module, '.-~', '+=/'));      
            if($type_of_module != "x"){ 
            $where["d.type_of_module"]	= $type_of_module; // Type of Module Filter
            }
        } 
        $defect_source = $this->rejection_rate_mod->get_detail_data_ctq_v21($where);
        unset($where);
        foreach($defect_source as $key => $val){
            $find_length_of_defect[$val['id_joint']][] 		= $val['length'];
        }

    } else {

        $defect_source = array();

    } 

    if(sizeof($data['visual_data']) > 0){
        $get_data_ndt= array_column($data['visual_data'], 'id_visual');
        $where_ndt["a.id_visual IN ('".implode("', '", $get_data_ndt)."')"] = NULL;
        $data['ndt_data'] = $this->rejection_rate_mod->get_ndt_data_v21($where_ndt);
        unset($where_ndt); 
    } else {
        $data['ndt_data'] = null;
    }  

    $data_reject = array();       
    foreach($data['ndt_data'] as $key => $v){
        $data_reject[$v['id_visual']] += $v['length'];
    } 
 
   
    $count        = [];
    $array_process_length = array(); 
 

    foreach($data['visual_data'] as $key => $value){  

        $array_process_length[] = array(  
            "id_visual"              => $value['id_visual'], 
            "total_weld_length"      => $value['length_of_weld'],
            "total_tested_length"    => $value['tested_length'], 
            "total_reject_length"    => array_sum($find_length_of_defect[$val['id_joint']]), 
            "weld_datetime"          => $value['weld_datetime'],
            "week_no"                => date("W-Y",strtotime($value['tested_date'])),
            "id_joint"               => $value['id_joint'],
            "ndt_type"               => $value['ndt_initial'],
            "weld_length_overall"    => $value['length_of_weld'],
            "tested_length_overall"  => $value['tested_length'],

        );

    }
 
 
    //--------------- Grouping process Welding ----------------//
      
        $search_total_weld_of_length     = array();
        $search_total_tested_length      = array();
        $search_total_defect_length      = array();

        $search_total_weld_of_length_ut  = array();
        $search_total_tested_length_ut   = array();
        $search_total_defect_length_ut   = array();

        $search_total_weld_of_length_rt  = array();
        $search_total_tested_length_rt   = array();
        $search_total_defect_length_rt   = array();
      
 
        
        foreach($array_process_length as $key => $value){

            // Overall Data //

            if(!isSet($search_total_weld_of_length[$value["week_no"]])) {
                $search_total_weld_of_length[$value["week_no"]] = 0;
            }
            $search_total_weld_of_length[$value["week_no"]] += $value["total_weld_length"];
            
            if(!isSet($search_total_tested_length[$value["week_no"]])) {
                $search_total_tested_length[$value["week_no"]] = 0;
            }
            $search_total_tested_length[$value["week_no"]] += $value["total_tested_length"];

            if(!isSet($search_total_defect_length[$value["week_no"]])) {
                $search_total_defect_length[$value["week_no"]] = 0;
            }
            $search_total_defect_length[$value["week_no"]] += $value["total_reject_length"];
            
            // Overall Data //
                       
            if($value["ndt_type"] == 'UT'){ 

                // Overall Data //

                if(!isSet($search_total_weld_of_length_ut["UT"][$value["week_no"]])) {
                    $search_total_weld_of_length_ut["UT"][$value["week_no"]] = 0;
                }
                $search_total_weld_of_length_ut["UT"][$value["week_no"]] += $value["total_weld_length"];
                
                if(!isSet($search_total_tested_length_ut["UT"][$value["week_no"]])) {
                    $search_total_tested_length_ut["UT"][$value["week_no"]] = 0;
                }
                $search_total_tested_length_ut["UT"][$value["week_no"]] += $value["total_tested_length"];

                if(!isSet($search_total_defect_length_ut["UT"][$value["week_no"]])) {
                    $search_total_defect_length_ut["UT"][$value["week_no"]] = 0;
                }
                $search_total_defect_length_ut["UT"][$value["week_no"]] += $value["total_reject_length"];
                
                // Overall Data // 

            } 

            if($value["ndt_type"] == 'RT'){

                // Overall Data //

                if(!isSet($search_total_weld_of_length_rt["RT"][$value["week_no"]])) {
                    $search_total_weld_of_length_rt["RT"][$value["week_no"]] = 0;
                }
                $search_total_weld_of_length_rt["RT"][$value["week_no"]] += $value["total_weld_length"];
                
                if(!isSet($search_total_tested_length_rt["RT"][$value["week_no"]])) {
                    $search_total_tested_length_rt["RT"][$value["week_no"]] = 0;
                }
                $search_total_tested_length_rt["RT"][$value["week_no"]] += $value["total_tested_length"];

                if(!isSet($search_total_defect_length_rt["RT"][$value["week_no"]])) {
                    $search_total_defect_length_rt["RT"][$value["week_no"]] = 0;
                }
                $search_total_defect_length_rt["RT"][$value["week_no"]] += $value["total_reject_length"];
                
                // Overall Data // 
                
            } 

        }
        
        $grouping_data_all    = array();
        $grouping_data_all_UT = array();
        $grouping_data_all_RT = array();

        foreach($array_process_length as $key => $value){ 

            $grouping_data_all[$value["week_no"]] = array(
                "total_weld_of_length_all"   => ($search_total_weld_of_length[$value["week_no"]] ? $search_total_weld_of_length[$value["week_no"]] : 0),
                "total_tested_length_all"    => ($search_total_tested_length[$value["week_no"]] ? $search_total_tested_length[$value["week_no"]] : 0),
                "total_reject_all"           => ($search_total_defect_length[$value["week_no"]] ? $search_total_defect_length[$value["week_no"]] : 0),
                "week_no"                    => $value["week_no"]   
            ); 

            $grouping_data_all_UT[$value["week_no"]]["UT"] = array(
                "total_weld_of_length_all_ut"   => ($search_total_weld_of_length_ut["UT"][$value["week_no"]] ? $search_total_weld_of_length_ut["UT"][$value["week_no"]] : 0),
                "total_tested_length_all_ut"    => ($search_total_tested_length_ut["UT"][$value["week_no"]] ? $search_total_tested_length_ut["UT"][$value["week_no"]] : 0),
                "total_reject_all_ut"           => ($search_total_defect_length_ut["UT"][$value["week_no"]] ? $search_total_defect_length_ut["UT"][$value["week_no"]] : 0),
                "ndt_type_ut"                   => "UT",                        
                "week_no"                       => $value["week_no"]   
            );

            $grouping_data_all_RT[$value["week_no"]]["RT"] = array(
                "total_weld_of_length_all_rt"   => ($search_total_weld_of_length_rt["RT"][$value["week_no"]] ? $search_total_weld_of_length_rt["RT"][$value["week_no"]] : 0),
                "total_tested_length_all_rt"    => ($search_total_tested_length_rt["RT"][$value["week_no"]] ? $search_total_tested_length_rt["RT"][$value["week_no"]] : 0),
                "total_reject_all_rt"           => ($search_total_defect_length_rt["RT"][$value["week_no"]] ? $search_total_defect_length_rt["RT"][$value["week_no"]] : 0),
                "ndt_type_rt"                   => "RT",                        
                "week_no"                       => $value["week_no"]   
            ); 

        }
     
    //--------------- Grouping process Welding ----------------//

    $data["rejection_rate_all"]     = $grouping_data_all;
    $data["rejection_rate_all_ut"]  = $grouping_data_all_UT;
    $data["rejection_rate_all_rt"]  = $grouping_data_all_RT; 

    $data["start_cut_off"]          = $start_date_group;
    $data["end_cut_off"]            = $end_date_group;
    $data["looping_week"]           = $data_array_date_x; 

    //--------------- link data ----------------//

    $data["type_link"]              = $type;
    $data["type_of_module_link"]    = $type_of_module;
    $data["discipline_link"]        = $discipline;

    //--------------- link data ----------------// 
  
    $data['user_cookie'] 	        = $this->user_cookie;
    $data['user_permission']        = $this->permission_cookie;
    $data['meta_title']   	        = 'Rejection Rate';
    $data['subview']      	        = 'rejection_rate/rejection_rate_all';
    $data['sidebar']      	        = $this->sidebar;

    $this->load->view('index', $data);

}


public function audit_weekly($week = null ,$type = null ,$type_of_module = null , $discipline = null){

    error_reporting(0);

    $datadb = $this->general_mod->discipline();
    $discipline_list = [];
    foreach ($datadb as $key => $value) {
        $discipline_list[$value['initial']] = $value;
        $data['discipline_list_data'][$value['id']] = $value;
        $data['discipline_code'][$value['id']] = $value['initial'];
    }
    $data['discipline_list'] = $discipline_list;

    $datadb = $this->visual_mod->master_welder_new();
    foreach ($datadb as $key => $value) {
        $data["master_welder"][$value['id_welder']] = $value;
    }

    $datadb = $this->general_mod->type_of_module();
    $type_of_module_list = [];
    foreach ($datadb as $key => $value) {
        $type_of_module_list[$value['code']] = $value;
        $data['type_of_module_code'][$value['id']] = $value['code'];
    }
    $data['type_of_module_list'] = $type_of_module_list;

    $datadb = $this->general_mod->module();
    $module_list = [];
    foreach ($datadb as $key => $value) {
        $module_list[$value['mod_id']] = $value;
        $data['module_code'][$value['mod_id']] = $value['mod_desc'];
    }
    $data['module_list'] = $module_list;

    $week           = $this->encryption->decrypt(strtr($week, '.-~', '+=/'));      
    $type           = $this->encryption->decrypt(strtr($type, '.-~', '+=/'));      
    $type_of_module = $this->encryption->decrypt(strtr($type_of_module, '.-~', '+=/'));  
    $discipline     = $this->encryption->decrypt(strtr($discipline, '.-~', '+=/'));    

    if($type == "cmltv"){
        $data["title_menu"]     = "Comulative Data - Rejection Rate";
        $data["title_code"]     = "cmltv";
        $data["chart_code"]     = "Overall Comulative";
    } else if($type == "ts"){
        $data["title_menu"]     = "Top Side - Rejection Rate";
        $data["title_code"]     = "ts";
        $data["chart_code"]     = "Top Side";
    } else if($type == "jkt"){
        $data["title_menu"]     = "Jacket - Rejection Rate";
        $data["title_code"]     = "jkt";
        $data["chart_code"]     = "Jacket";
    } else if($type == "str"){
        $data["title_menu"]     = "Structural - Rejection Rate";
        $data["title_code"]     = "str";
        $data["chart_code"]     = "Structural";
    } else if($type == "pip"){
        $data["title_menu"]     = "Piping - Rejection Rate";
        $data["title_code"]     = "pip";
        $data["chart_code"]     = "Piping";
    } else {
        $data["title_menu"]     = "Comulative Data - Rejection Rate";
        $data["title_code"]     = "cmltv";
        $data["chart_code"]     = "Overall Comulative";
    }

    // ------- Date Populated ----------//


    $period = new DatePeriod(
        new DateTime('2021-10-15'),
        new DateInterval('P1D'),
        new DateTime(date("Y-m-d"))
    );

    foreach ($period as $key => $value) {         
       $grouping_week[] = ($value->format('W-Y') == "52-2022" ? "51-2021" : $value->format('W-Y'));   
    }

    $get_unique_week = array_unique($grouping_week);
    

    function getStartAndEndDate($year_week) {
        $week = substr($year_week,0,2);
        $year = substr($year_week,-4);
        $dto = new DateTime();
        $dto->setISODate($year, $week);
        $ret['week_start'] = $dto->format('Y-m-d');
        $dto->modify('+7 days');
        $ret['week_end'] = $dto->format('Y-m-d');            
        return $ret;
    }
  
    function getRangedate($start, $end) {
        $period = new DatePeriod(
            new DateTime($start),
            new DateInterval('P1D'),
            new DateTime($end)
        );
        $array_populated = array();
        foreach ($period as $key => $value) {
            $array_populated[] = $value->format('Y-m-d');
        }
        return $array_populated;
    }

    $data_array_date = [];
    foreach($get_unique_week as $key => $value){            
        $week_no = getStartAndEndDate($value);
        $data_array_date[] = array_reverse(getRangedate($week_no["week_start"], $week_no["week_end"]));            
        $data_array_date_x[date("W-Y",strtotime($week_no["week_start"]))] = array_reverse(getRangedate($week_no["week_start"], $week_no["week_end"]));            
    }

    $selected_week = array();
    foreach($data_array_date_x as $key => $value){
        if($key == $week){
            $selected_week[] = $value;
        }
    }

    $start_date_group = $selected_week[0][6];
    $end_date_group   = $selected_week[max(array_keys($selected_week))][0];  


    // ------- Date Populated ----------//

    // ------- Get Data Visual----------//

    if(isset($type_of_module) && !empty($type_of_module)){ 
        if($type_of_module != "x"){      
         $where["a.type_of_module"]  = $type_of_module;
        }
    }

    if(isset($discipline) && !empty($discipline)){ 
        if($discipline != "x"){      
            $where["a.discipline"]  = $discipline;
        }
    }
  
    $data['id_deck_list'] = [5,6,7,8,9,10,17]; 

    $where["date(d.tested_date) BETWEEN '". $start_date_group."' AND '".$end_date_group."'"]  = null; 
    $where["a.revision IS NULL AND a.revision_category IS NULL"]           = null;
    $where["c.deck_elevation IN(".join(", ", $data['id_deck_list']).")"]   = null;  
    if(!$this->is_admin) {
      $where[implode_where("c.project", $this->project_alt)]  = null;
    } 
    $where["d.ndt_type IN (1,3)"]           = null;
    $where["d.result IN (0,2,3)"]           = null;
    $data['visual_data'] = $this->rejection_rate_mod->get_visual_data_new_v21($where); 
    unset($where); 

    if(sizeof($data['visual_data']) > 0){
    
        $where["b.result"]   = 2; 
        $where["b.ndt_type"] = 3; 
        $id_joint_vs   = array_unique(array_column($data['visual_data'],'id_joint')); 
        $where["d.id IN ('".implode("', '", $id_joint_vs)."')"] = NULL;  
        if(isset($type_of_module) && !empty($type_of_module)){
            $type_of_module = $this->encryption->decrypt(strtr($type_of_module, '.-~', '+=/'));      
            if($type_of_module != "x"){ 
            $where["d.type_of_module"]	= $type_of_module; // Type of Module Filter
            }
        } 
        $defect_source = $this->rejection_rate_mod->get_detail_data_ctq_v21($where);
        unset($where);
        foreach($defect_source as $key => $val){
            $find_length_of_defect[$val['id_joint']][] 		= $val['length'];
            $data["find_length_of_defect_audit"][$val['id_joint']][$val['rh_fc_type']][] 		= $val['length'];
        }

        $id_joint_vs   = array_unique(array_column($data['visual_data'],'id_joint')); 
        $get_visual_data = $this->rejection_rate_mod->get_welder_data_visual_v21($where);
        foreach($get_visual_data as $key => $val){
            $data["welder_data"][$val['id_visual']][$val['status_rh_fc']][] 		= $val['id_welder']; 
        }

    } else {

        $defect_source = array();
        $get_visual_data = array();

    }  
      

  // ------- Get Data Visual----------//

  $data["start_cut_off"]       = $start_date_group;
  $data["end_cut_off"]         = $end_date_group; 
  $data["week_date"]           = $week;

  $data['user_cookie'] 	       = $this->user_cookie;
  $data['user_permission']     = $this->permission_cookie;
  $data['meta_title']   	   = 'Rejection Rate';
  $data['subview']      	   = 'rejection_rate/data_audit';
  $data['sidebar']      	   = $this->sidebar;

  $this->load->view('index', $data);

  
               

}

}