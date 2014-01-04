MONGO-GeoHashing
================

Introduction 
-------------------------------------------------------------
A complete project in which a MySql db is used as source of Points data, read, geohashed, and saved in Mongodb.

Requirements
-------------------------------------------------------------
    PHP 5.2 or greater
    CodeIgniter 2.1.0 to 3.0-dev
	Mongodb 2.4.8 or greater
	
Manual Installation
-------------------------------------------------------------

   1)Download Package
   
   2)Move into target directories

Usage
-------------------------------------------------------------
MySql db is used as source of Points data, read, geohashed, and saved in Mongodb

function insertGeohash() {

----
		
----
		
----
		
	$collection = $this->mongo_db->db->selectCollection('geohashcoll'); //select collection name for mongodb
		
	$collection->insert($insert);	//insert data into geohashcoll collection of mongodb
		
}	

Support
-------------------------------------------------------------

If you have an issues, please send me an email at "mukeshpal@synsoftglobal.com" and if you still need help, open a bug report in GitHub's issue tracker.