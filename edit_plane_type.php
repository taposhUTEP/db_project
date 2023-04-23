<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';


// Sanitize if you want
$PLtype = filter_input(INPUT_GET, 'PLtype', FILTER_VALIDATE_INT);
$operation = filter_input(INPUT_GET, 'operation', FILTER_SANITIZE_STRING); 
($operation == 'edit') ? $edit = true : $edit = false;
 $db = getDbInstance();

//Handle update request. As the form's action attribute is set to the same script, but 'POST' method, 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    //Get plane_type id form query string parameter.
    $PLtype = filter_input(INPUT_GET, 'PLtype', FILTER_SANITIZE_STRING);

    //Get input data
    $data_to_update = filter_input_array(INPUT_POST);
    
    $db = getDbInstance();
    $db->where('PLtype', $PLtype);
    $stat = $db->update('max_and_min_time_per_plcategory', $data_to_update);

    if($stat)
    {
        $_SESSION['success'] = "plane_type updated successfully!";
        //Redirect to the listing page,
        header('location: plane_types.php');
        //Important! Don't execute the rest put the exit/die. 
        exit();
    }
}


//If edit variable is set, we are performing the update operation.
if(true)
{
    print_r($_SERVER['QUERY_STRING']);
    $db->where('PLtype', $PLtype);
    //Get data to pre-populate the form.
    $plane_type = $db->getOne("max_and_min_time_per_plcategory");
    echo "Plane Type";
    print_r($plane_type);
}
?>


<?php
    include_once 'includes/header.php';
?>
<h1> Hello <?php echo '$plane_type';?></h1>
<div id="page-wrapper">
    <div class="row">
        <h2 class="page-header">Update plane_type</h2>
    </div>
    <!-- Flash messages -->
    <?php
        include('./includes/flash_messages.php')
    ?>

    <form class="" action="" method="post" enctype="multipart/form-data" id="contact_form">
        
        <?php
            //Include the common form for add and edit  
            require_once('./forms/plane_type_form.php'); 
        ?>
    </form>
</div>




<?php include_once 'includes/footer.php'; ?>