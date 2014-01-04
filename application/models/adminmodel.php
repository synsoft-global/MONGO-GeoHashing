<?php 
/*
* @category- Geohash
* @author-  Synsoft Global Developer
* @author- website  www.synsoftglobal.com
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Adminmodel extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->library('geohash'); // library where all the logics are written about converting lat-lng into geohash code and vice versa
		$this->load->library('mongo_db'); //library to use the features of mongodb
	}
	
	function insertGeohash() //for inserting records with geohashcode in mongodb collection
	{
		$query = $this->db->get('pa_test');
		$res = $query->result();
		foreach($res as $row){
			$geoHash = new GeoHash; //create object of geohash class from library
			$geoHash->setLatitude($row->lat) ; // set latitude from calling setLatitude method of geohash library
			$geoHash->setLongitude($row->lng); // set longitude from calling setLongitude method of geohash library
			$geoHash->setPrecision(0.0001); // set precision to 8 digit alphanumeric characters i.e. geohash code
			$geo = $geoHash->createHash(); // create hash code
			$insert = array(
				'name' => $row->name,
				'category_list' => $row->category_list,
				'lat' => $row->lat,
				'lng' => $row->lng,
				'radius' => $row->radius,
				'address' => $row->address,
				'city' => $row->city,
				'state' => $row->state,
				'country' => $row->country,
				'location_group_id' => $row->location_group_id,
				'icon' => $row->icon,
				'reference' => $row->reference,
				'photo' => $row->photo,
				'json_dump' => $row->json_dump,
				'geohashcode' => $geo,	
			);
			$collection = $this->mongo_db->db->selectCollection('geohashcoll'); //select collection name for mongodb
			$collection->insert($insert);	//insert query for inserting data into geohashcoll collection of mongodb
		}	
	}
	
	
	
	/*  Get all the name,address,lat,lng,geohashcode from mongodb's collection to show map
		@plimit : An integer value pass for page limit
	*/
	function getGeoHash($plimit)
	{
		$collection = $this->mongo_db->db->selectCollection('geohashcoll');
		$geo = $collection->find(array(),array('name'=>1,'address'=>1,'lat'=>1,'lng'=>1,'geohashcode'=>1,'_id'=>0))->skip($plimit)->limit(1000);
		return $geo;
	}
	
	
}
