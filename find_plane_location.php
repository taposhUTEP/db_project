<?php
session_start();
require_once 'config/config.php';
require_once BASE_PATH . '/includes/auth_validate.php';
require_once 'includes/header.php'; 
// Costumers class
require_once BASE_PATH . '/lib/Costumers/Costumers.php';
$costumers = new Costumers();

// Get Input data from query string
$search_string = filter_input(INPUT_GET, 'search_string');
$filter_col = filter_input(INPUT_GET, 'filter_col');
$order_by = filter_input(INPUT_GET, 'order_by');
?>

 <!-- The End of the Header --><div id="page-wrapper">

<div class="row">
     <div class="col-lg-12">
            <h2 class="page-header">Find Plane Location</h2>
        </div>
        
</div>
    <form class="form" action="find_plane_location.php" method="post"  id="plane_form" enctype="multipart/form-data">
       

<fieldset>
    <div class="form-group">
        <label for="plane_code">Plane Code *</label>
          <input type="text" name="plane_code" value="" placeholder="Plane Code" class="form-control" required="required" id = "plane_code" >
    </div>

    

    <div class="form-group text-center">
        <label></label>
        <button type="submit" class="btn btn-warning" >Save <span class="glyphicon glyphicon-send"></span></button>
    </div>            
</fieldset>
    </form>

<?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){

            /**
             * Grab information from the form submission and store values into variables.
             */
            $plcode = isset($_POST['plane_code']) ? $_POST['plane_code'] : " ";  
            
            //Insert into Student table;
            
            $queryPlane  = "Select PLcode, PLgate, PLairport_code FROM plane WHERE PLcode =$plcode;";

            if ($result = $conn->query($queryPlane)) { 
                ?>
                        <table class="table table-striped table-bordered table-condensed">
            <thead>
                <th> Plane Code</th>
                <th> Gate</th>
                <th> Airport Code </th>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_row()) {
                ?>
                    <tr>
                    <td><?php printf("%s", $row[0]); ?></td>
                        <td><?php printf("%s", $row[1]); ?></td>
                        <td><?php printf("%s", $row[2]); ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <?php
            } 
}
?>

</div>
<script type="text/javascript">
$(document).ready(function(){
   $("#plane_form").validate({
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
