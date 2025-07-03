<?php
try {
session_start();	
$connexion=new PDO('mysql:dbname=muyisa_energie; host=localhost', 'root', '');
} catch (Exception $e) {
	echo $e;
	
}
