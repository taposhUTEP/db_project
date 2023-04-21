<?php
//Get DB instance. i.e instance of MYSQLiDB Library
$db = getDbInstance();
$select = array('PEssn', 'PEfname', 'PElname', 'PEstatus', 'PEbmonth', 'PEbyear', 'PEbday', 'PEgender', 'PEsalary');
// Set pagination limit
//$db->pageLimit = $pagelimit;

// Get result of the query.
$rows = $db->arraybuilder()->paginate('personnel', 1, $select);
//$total_pages = $db->totalPages;
?>

<fieldset>
    <div class="form-group">
        <label for="Tcode">Terminal Code *</label>
          <input type="text" name="Tcode" value="<?php echo htmlspecialchars($edit ? $team['Tcode'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Terminal Code" class="form-control" required="required" id = "Tcode" >
    </div> 

    <div class="form-group">
        <label for="Tstatus">Terminal Status *</label>
        <label class="radio-inline">
            <input type="radio" name="Tstatus" value="Available" <?php echo ($edit && strcasecmp($team['Tstatus'], 'available')==0) ? "checked": "" ; ?> required="required"/> available
        </label>
        <label class="radio-inline">
            <input type="radio" name="Tstatus" value="Unavailable" <?php echo ($edit && strcasecmp($team['Tstatus'], 'unavailable')==0) ? "checked": "" ; ?> required="required" id="Unavailable"/> Unavailable
        </label>
    </div> 

    <div class="form-group">
        <label for="PLtype">Plane Type *</label>
            <select name="PLtype" class="form-control selectpicker" required>
                <option value=" " >Select Supervisor</option>
                <?php
                foreach ($rows as $opt) {
                    if ($edit && $opt['PEssn'] == $team['PLtype']) {
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
        <label for="Tairport_code">Airport Code</label>
            <input  type="Tairport_code" name="Tairport_code" value="<?php echo htmlspecialchars($edit ? $team['Tairport_code'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Airport Code" class="form-control" id="Tairport_code">
    </div>

    <div class="form-group">
        <label for="Tgate">Terminal Gate</label>
            <input name="Tgate" value="<?php echo htmlspecialchars($edit ? $team['Tgate'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Terminal gate" class="form-control"  type="text" id="Tgate">
    </div> 

    <div class="form-group text-center">
        <label></label>
        <button type="submit" class="btn btn-warning" >Save <span class="glyphicon glyphicon-send"></span></button>
    </div>            
</fieldset>
