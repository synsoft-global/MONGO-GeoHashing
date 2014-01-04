<?php 
/*
* @category- Geohash
* @author-  Synsoft Global Developer
* @author- website  www.synsoftglobal.com
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Mongo_db
{
  public function __construct()
    {
 
                //Check mongodb is installed in your server otherwise display an error
        if ( ! class_exists('Mongo'))
        {
            $this->_show_error('The MongoDB PECL extension has not been installed or enabled', 500);
        }
         
                //get instance of CI class
        if (function_exists('get_instance'))
        {
            $this->_ci = get_instance();
        }
         
        else
        {
            $this->_ci = NULL;
        }  
         
                //load the config file which we have created in 'config' directory
        $this->_ci->load->config('mongodb');
 
               
            $config='default';
                // Fetch Mongo server and database configuration from config file which we have created in 'config' directory
                $config_data = $this->_ci->config->item($config); 
               
            try{
                   //connect to the mongodb server
           $this->mb = new Mongo('mongodb://'.$config_data['mongo_hostbase']);
                   //select the mongodb database
                   $this->db=$this->mb->selectDB($config_data['mongo_database']);
        }
        catch (MongoConnectionException $exception)
        {
                     //if mongodb is not connect, then display the error
            show_error('Unable to connect to Database', 500);          
        }
	}   
     
}
