<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';


// Sanitize if you want
$Tcode = filter_input(INPUT_GET, 'Tcode', FILTER_VALIDATE_INT);
$operation = filter_input(INPUT_GET, 'operation', FILTER_SANITIZE_STRING); 
($operation == 'edit') ? $edit = true : $edit = false;
 $db = getDbInstance();

//Handle update request. As the form's action attribute is set to the same script, but 'POST' method, 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    //Get team id form query string parameter.
    $Tcode = filter_input(INPUT_GET, 'Tcode', FILTER_SANITIZE_STRING);

    //Get input data
    $data_to_update = filter_input_array(INPUT_POST);
    
    $db = getDbInstance();
    $db->where('Tcode', $Tcode);
    $stat = $db->update('team_v2', $data_to_update);

    if($stat)
    {
        $_SESSION['success'] = "team updated successfully!";
        //Redirect to the listing page,
        header('location: teams.php');
        //Important! Don't execute the rest put the exit/die. 
        exit();
    }
}


//If edit variable is set, we are performing the update operation.
if($edit)
{
    $db->where('Tcode', $Tcode);
    //Get data to pre-populate the form.
    $team = $db->getOne("team_v2");
    //print_r($team);
}
?>


<?php
    include_once 'includes/header.php';
?>
<div id="page-wrapper">
    <div class="row">
        <h2 class="page-header">Update team</h2>
    </div>
    <!-- Flash messages -->
    <?php
        include('./includes/flash_messages.php')
    ?>

    <form class="" action="" method="post" enctype="multipart/form-data" id="contact_form">
        
        <?php
            //Include the common form for add and edit  
            require_once('./forms/team_form.php'); 
        ?>
    </form>
</div>




<?php include_once 'includes/footer.php'; ?>