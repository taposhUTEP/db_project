<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';


// Sanitize if you want
$PLcode = filter_input(INPUT_GET, 'PLcode', FILTER_VALIDATE_INT);
$operation = filter_input(INPUT_GET, 'operation', FILTER_SANITIZE_STRING); 
($operation == 'edit') ? $edit = true : $edit = false;
 $db = getDbInstance();

//Handle update request. As the form's action attribute is set to the same script, but 'POST' method, 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    //Get plane id form query string parameter.
    $PLcode = filter_input(INPUT_GET, 'PLcode', FILTER_SANITIZE_STRING);

    //Get input data
    $data_to_update = filter_input_array(INPUT_POST);
    
    $db = getDbInstance();
    $db->where('PLcode', $PLcode);
    $stat = $db->update('plane', $data_to_update);

    if($stat)
    {
        $_SESSION['success'] = "plane updated successfully!";
        //Redirect to the listing page,
        header('location: planes.php');
        //Important! Don't execute the rest put the exit/die. 
        exit();
    }
}


//If edit variable is set, we are performing the update operation.
if($edit)
{
    $db->where('PLcode', $PLcode);
    //Get data to pre-populate the form.
    $plane = $db->getOne("plane");
    //print_r($plane);
}
?>


<?php
    include_once 'includes/header.php';
?>
<div id="page-wrapper">
    <div class="row">
        <h2 class="page-header">Update plane</h2>
    </div>
    <!-- Flash messages -->
    <?php
        include('./includes/flash_messages.php')
    ?>

    <form class="" action="" method="post" enctype="multipart/form-data" id="contact_form">
        
        <?php
            //Include the common form for add and edit  
            require_once('./forms/plane_form.php'); 
        ?>
    </form>
</div>




<?php include_once 'includes/footer.php'; ?>