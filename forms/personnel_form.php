<fieldset>
    <div class="form-group">
        <label for="Pessn">PEssn *</label>
          <input type="text" name="PEssn" value="<?php echo htmlspecialchars($edit ? $personnel['PEssn'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="PEssn" class="form-control" required="required" id = "PEssn" >
    </div> 

    <div class="form-group">
        <label for="PEfname">First Name *</label>
        <input type="text" name="PEfname" value="<?php echo htmlspecialchars($edit ? $personnel['PEfname'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="First Name" class="form-control" required="required" id="PEfname">
    </div> 

    <div class="form-group">
        <label for="PElname">Last Name *</label>
        <input type="text" name="PElname" value="<?php echo htmlspecialchars($edit ? $personnel['PElname'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Last Name" class="form-control" required="required" id="PElname">
    </div> 

    <div class="form-group">
        <label for="PEstatus">Status *</label>
        <input type="text" name="PEstatus" value="<?php echo htmlspecialchars($edit ? $personnel['PEstatus'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Status" class="form-control" required="required" id="PEstatus">
    </div> 

    <div class="form-group">
        <label for="PEbdate">Birthdate *</label>
        <input type="date" name="PEbdate" value="<?php echo htmlspecialchars($edit ? $personnel['PEbdate'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Birthdate" class="form-control" required="required" id="PEbdate">
    </div> 

    <div class="form-group">
        <label>Gender * </label>
        <label class="radio-inline">
            <input type="radio" name="PEgender" value="male" <?php echo ($edit &&$personnel['PEgender'] =='male') ? "checked": "" ; ?> required="required"/> Male
        </label>
        <label class="radio-inline">
            <input type="radio" name="PEgender" value="female" <?php echo ($edit && $personnel['PEgender'] =='female')? "checked": "" ; ?> required="required" id="female"/> Female
        </label>
    </div>

    <div class="form-group">
        <label for="PEphone_number">Phone Number *</label>
        <input type="text" name="PEphone_number" value="<?php echo htmlspecialchars($edit ? $personnel['PEphone_number'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Phone Number" class="form-control" required="required" id="PEphone_number">
    </div>

    <div class="form-group">
        <label for="PEsalary">Salary *</label>
        <input type="text" name="PEsalary" value="<?php echo htmlspecialchars($edit ? $personnel['PEsalary'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Salary" class="form-control" required="required" id="PEsalary">
    </div>

    <div class="form-group text-center">
        <label></label>
        <button type="submit" class="btn btn-warning" >Save <span class="glyphicon glyphicon-send"></span></button>
    </div>            
</fieldset>
