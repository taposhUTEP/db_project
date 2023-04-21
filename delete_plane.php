<?php 
session_start();
require_once 'includes/auth_validate.php';
require_once './config/config.php';
$del_id = filter_input(INPUT_POST, 'del_id');
if ($del_id && $_SERVER['REQUEST_METHOD'] == 'POST') 
{

	if($_SESSION['admin_type']!='admin'){
		$_SESSION['failure'] = "You don't have permission to perform this action";
    	header('location: planes.php');
        exit;

	}
    $PEssn = $del_id;

    $db = getDbInstance();
    $db->where('PLcode', $PEssn);
    $status = $db->delete('plane');
    
    if ($status) 
    {
        $_SESSION['info'] = "plane deleted successfully!";
        header('location: planes.php');
        exit;
    }
    else
    {
    	$_SESSION['failure'] = "Unable to delete plane";
    	header('location: planes.php');
        exit;

    }
    
}