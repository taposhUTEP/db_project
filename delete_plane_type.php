<?php 
session_start();
require_once 'includes/auth_validate.php';
require_once './config/config.php';
$del_id = filter_input(INPUT_POST, 'del_id');
if ($del_id && $_SERVER['REQUEST_METHOD'] == 'POST') 
{

	if($_SESSION['admin_type']!='admin'){
		$_SESSION['failure'] = "You don't have permission to perform this action";
    	header('location: plane_types.php');
        exit;

	}
    $PEssn = $del_id;

    $db = getDbInstance();
    $db->where('PLtype', $PEssn);
    $status = $db->delete('max_and_min_time_per_plcategory');
    
    if ($status) 
    {
        $_SESSION['info'] = "plane_type deleted successfully!";
        header('location: plane_types.php');
        exit;
    }
    else
    {
    	$_SESSION['failure'] = "Unable to delete plane_type";
    	header('location: plane_types.php');
        exit;

    }
    
}