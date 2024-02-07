<?php

include "includes/connection.php";
$categid=$_POST["fname"];

?>
                                    <label class="form-label" for="desig">Designation :</label>
                                       
                                            <select name="desig" id="desig" class="form-control form-select select2" data-bs-placeholder="Select Designation" required>
                                                            <option value="" disabled selected>Select Designation</option>
                                                            <?php
                                                                $query = "select * from designation where department_id='" . $categid . "'";
                                                                $select_posts = mysqli_query($connection,$query);
                                                                while($row = mysqli_fetch_assoc($select_posts))
                                                                {
                                                            ?>
                                                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['designation'] ?></option>
                                                            <?php } ?>   
                                            </select>
                                       
