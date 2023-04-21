
<?php
//Get DB instance. i.e instance of MYSQLiDB Library
$db = getDbInstance();
$select = array('PLtype');
// Set pagination limit
//$db->pageLimit = $pagelimit;

// Get result of the query.
$rows = $db->arraybuilder()->paginate('max_and_min_time_per_plcategory', 1, $select);
//$total_pages = $db->totalPages;

//print_r($rows);
//foreach ($rows as $opt){
//    print_r($opt['PLtype']);
//}

$team_rows = $db->arraybuilder()->paginate('team', 1, array('Tcode'));
//print_r($plane)
?>

<fieldset>
    <div class="form-group">
        <label for="PLcode">Place Code *</label>
          <input type="text" name="PLcode" value="<?php echo htmlspecialchars($edit ? $plane['PLcode'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Plane Code" class="form-control" required="required" id = "PLcode" >
    </div>

    <div class="form-group">
        <label for="PLtype">Plane Type *</label>
            <select name="PLtype" class="form-control selectpicker" required>
                <option value=" " >Select Plane Type</option>
                <?php
                foreach ($rows as $opt) {
                    if ($edit && $opt['PLtype'] == $plane['PLtype']) {
                        $sel = "selected";
                    } else {
                        $sel = "";
                    }
                    echo '<option value="'.$opt['PLtype'].'"' . $sel . '>' . $opt['PLtype'] . '</option>';
                }

                ?>
            </select>
    </div> 
    
    <div class="form-group">
        <label for="PLgate">Terrminal Gate *</label>
          <input type="text" name="PLgate" value="<?php echo htmlspecialchars($edit ? $plane['PLgate'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Terminal Gate" class="form-control" required="required" id = "PLgate" >
    </div> 

    <div class="form-group">
        <label for="PLairport_code">Airport Code *</label>
          <input type="text" name="PLairport_code" value="<?php echo htmlspecialchars($edit ? $plane['PLairport_code'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Airport Code" class="form-control" required="required" id = "PLairport_code" >
    </div> 

    <div class="form-group">
        <label for="SERservice_number">Service Number *</label>
          <input type="text" name="SERservice_number" value="<?php echo htmlspecialchars($edit ? $plane['SERservice_number'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Service Number" class="form-control" required="required" id = "SERservice_number" >
    </div> 

    <div class="form-group">
        <label for="SERduration">Service Duration *</label>
          <input type="text" name="SERduration" value="<?php echo htmlspecialchars($edit ? $plane['SERduration'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Service Duration" class="form-control" required="required" id = "SERduration" >
    </div> 

    <div class="form-group">
        <label for="SERdate">Service Date *</label>
          <input type="date" name="SERdate" value="<?php echo htmlspecialchars($edit ? $plane['SERdate'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Service Date" class="form-control" required="required" id = "SERdate" >
    </div> 

    <div class="form-group">
        <label for="Tcode">Team *</label>
        <select name="Tcode" class="form-control selectpicker" required>
                <option value=" " >Select Team</option>
                <?php
                foreach ($team_rows as $opt) {
                    if ($edit && $opt['Tcode'] == $plane['Tcode']) {
                        $sel = "selected";
                    } else {
                        $sel = "";
                    }
                    echo '<option value="'.$opt['Tcode'].'"' . $sel . '>' . $opt['Tcode'] . '</option>';
                }

                ?>
            </select>
    </div> 


    <div class="form-group text-center">
        <label></label>
        <button type="submit" class="btn btn-warning" >Save <span class="glyphicon glyphicon-send"></span></button>
    </div>            
</fieldset>
