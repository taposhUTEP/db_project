<?php
session_start();
require_once './config/config.php';
require_once './includes/auth_validate.php';


//serve POST method, After successful insert, redirect to personnel.php page.
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    //Mass Insert Data. Keep "name" attribute in html form same as column name in mysql table.
    $data_to_store = array_filter($_POST);
    $data_to_store_for_phone = array();

    $db = getDbInstance();
    $year_mont_day = explode('-', $data_to_store['PEbdate']);
    $data_to_store['PEbyear'] = $year_mont_day[0];
    $data_to_store['PEbmonth'] = $year_mont_day[1];
    $data_to_store['PEbday'] = $year_mont_day[2];
    unset($data_to_store['PEbdate']);
    print_r($data_to_store);
    
    $data_to_store_for_phone['PEssn'] = $data_to_store['PEssn'];
    $data_to_store_for_phone['PEphone_number'] = $data_to_store['PEphone_number'];
    unset($data_to_store['PEphone_number']);

    $last_id = $db->insert('personnel', $data_to_store);

    $db->insert('person_phone_number', $data_to_store_for_phone);

    if($last_id)
    {
    	$_SESSION['success'] = "personnel added successfully!";
    	header('location: personnels.php');
    	exit();
    }
    else
    {
        echo 'insert failed: ' . $db->getLastError();
        exit();
    }
}

//We are using same form for adding and editing. This is a create form so declare $edit = false.
$edit = false;

require_once 'includes/header.php'; 
?>
<div id="page-wrapper">
<div class="row">
     <div class="col-lg-12">
            <h2 class="page-header">Add personnel</h2>
        </div>
        
</div>
    <form class="form" action="" method="post"  id="personnel_form" enctype="multipart/form-data">
       <?php  include_once('./forms/personnel_form.php'); ?>
    </form>
</div>


<script type="text/javascript">
$(document).ready(function(){
   $("#personnel_form").validate({
       rules: {
            f_name: {
                required: true,
                minlength: 3
            },
            l_name: {
                required: true,
                minlength: 3
            },   
        }
    });
});
</script>

<?php include_once 'includes/footer.php'; ?>
