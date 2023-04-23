
<fieldset>
    <div class="form-group">
        <label for="PLtype">Plane Type *</label>
          <input type="text" name="PLtype" value="<?php echo htmlspecialchars($edit ? $plane_type['PLtype'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Plane Type" class="form-control" required="required" id = "PLtype" >
    </div> 

    <div class="form-group">
        <label for="PLmin_clean_time">Minimum Cleaning Time *</label>
          <input type="text" name="PLmin_clean_time" value="<?php echo htmlspecialchars($edit ? $plane_type['PLmin_clean_time'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Minimum Cleaning Time" class="form-control" required="required" id = "PLmin_clean_time" >
    </div>

    <div class="form-group">
        <label for="PLmax_clean_time">Maximum Cleaning Time *</label>
          <input type="text" name="PLmax_clean_time" value="<?php echo htmlspecialchars($edit ? $plane_type['PLmax_clean_time'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Maximum Cleaning Time" class="form-control" required="required" id = "PLmax_clean_time" >
    </div>

    <div class="form-group text-center">
        <label></label>
        <button type="submit" class="btn btn-warning" >Save <span class="glyphicon glyphicon-send"></span></button>
    </div>            
</fieldset>
