<?php 
session_start();
require_once 'includes/auth_validate.php';
require_once './config/config.php';
$del_id = filter_input(INPUT_POST, 'del_id');
if ($del_id && $_SERVER['REQUEST_METHOD'] == 'POST') 
{

	if($_SESSION['admin_type']!='admin'){
		$_SESSION['failure'] = "You don't have permission to perform this action";
    	header('location: personnels.php');
        exit;

	}
    $PEssn = $del_id;

    $db = getDbInstance();
    $db->where('PEssn', $PEssn);
    $status = $db->delete('personnel');
    
    if ($status) 
    {
        $_SESSION['info'] = "personnel deleted successfully!";
        header('location: personnels.php');
        exit;
    }
    else
    {
    	$_SESSION['failure'] = "Unable to delete personnel";
    	header('location: personnels.php');
        exit;

    }
    
}