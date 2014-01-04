<?php 
/*
* @category- Geohash
* @author-  Synsoft Global Developer
* @author- website  www.synsoftglobal.com
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Admin extends CI_Controller {
	//public $loggedin;
	function __construct()
	{
		parent::__construct();
		$this->load->model('Adminmodel');
	}
	
	/*
	 * function to show map with geohash code
	 */ 
	function index()
	{
		$this->load->view('map');	
	}
	
	/*
	 * for getting markers i.e. called from ajax
	 */ 
	function getmarker()
	{
		$plimit = $this->input->post('plimit',true);
		
		$marker = array();
		$marker1 = array();
		$marker1 = $this->Adminmodel->getGeoHash($plimit);
		$data = iterator_to_array($marker1);
        $total=count($data);		
		$new_array12 = json_encode(array('result'=>$data,'total'=>$total));
		echo $new_array12 ;
		die;
	}
		
	/*
	 * function to add records with geohash code into Mongodb
	 */ 
	function addGeoHash()
	{
		$this->Adminmodel->insertGeohash();
			
	} 
	
}
