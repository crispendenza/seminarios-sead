<?php

// This is the database connection configuration.
return array(
	//'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',s	
	'connectionString' => 'pgsql:host=localhost;port=5432;dbname=seminarios_sead',
	'emulatePrepare' => true,
	'username' => 'postgres',
	'password' => '123456',
	'charset' => 'utf8',
	
);