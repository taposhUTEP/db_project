<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';


// Sanitize if you want
$Pessn = filter_input(INPUT_GET, 'Pessn', FILTER_VALIDATE_INT);
$operation = filter_input(INPUT_GET, 'operation', FILTER_SANITIZE_STRING); 
($operation == 'edit') ? $edit = true : $edit = false;
 $db = getDbInstance();

//Handle update request. As the form's action attribute is set to the same script, but 'POST' method, 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    //Get personnel id form query string parameter.
    $Pessn = filter_input(INPUT_GET, 'Pessn', FILTER_SANITIZE_STRING);

    //Get input data
    $data_to_update = filter_input_array(INPUT_POST);
    
    $db = getDbInstance();
    $db->where('Pessn', $Pessn);
    $stat = $db->update('personnel', $data_to_update);

    if($stat)
    {
        $_SESSION['success'] = "personnel updated successfully!";
        //Redirect to the listing page,
        header('location: personnel.php');
        //Important! Don't execute the rest put the exit/die. 
        exit();
    }
}


//If edit variable is set, we are performing the update operation.
if($edit)
{
    $db->where('Pessn', $Pessn);
    //Get data to pre-populate the form.
    $personnel = $db->getOne("personnel");
    //print_r($personnel);
}
?>


<?php
    include_once 'includes/header.php';
?>
<div id="page-wrapper">
    <div class="row">
        <h2 class="page-header">Update personnel</h2>
    </div>
    <!-- Flash messages -->
    <?php
        include('./includes/flash_messages.php')
    ?>

    <form class="" action="" method="post" enctype="multipart/form-data" id="contact_form">
        
        <?php
            //Include the common form for add and edit  
            require_once('./forms/personnel_form.php'); 
        ?>
    </form>
</div>




<?php include_once 'includes/footer.php'; ?>
