<?php

include "includes/connection.php";
$categid = $_POST["fname"];

?>
<label class="col-md-2 form-label" for="catesubcategorygory">Sub Category Name :</label>
<div class="col-md-10">
    <select class="form-control select2" multiple="multiple" name="subcategory[]" id="subcategory[]" required>

        <?php
        
        $query = "select * from subcategory";
        $select_posts = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($select_posts)) {
            $combo = "No";
            $querysub = "select * from combocategory where category_id = '" . $categid . "' and subcategory_id ='" . $row['id'] . "'";
            $select_postssub = mysqli_query($connection, $querysub);
            while ($rowsub = mysqli_fetch_assoc($select_postssub)) {
                $combo = "Yes";
            }

        ?>
   <option value="<?php echo $row['id'] ?>" <?php echo ($combo === "Yes") ? "selected" : ""; ?>><?php echo $row['subcategory'] ?></option>
      <?php } ?>
    </select>
</div>

<script src="../assets/plugins/select2/js/select2.full.min.js"></script>
    <script src="../assets/js/select2.js"></script>