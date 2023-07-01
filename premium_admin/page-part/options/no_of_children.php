
                            <option value="No Child"  <?php if(isset($row['tot_children'])){ if($row['tot_children'] == 'No Child'){ echo 'selected';}} ?>>None</option>
                            <option value="One" <?php if(isset($row['tot_children'])){ if($row['tot_children'] == 'One'){ echo 'selected';}} ?>>One</option>
                            <option value="Two" <?php if(isset($row['tot_children'])){ if($row['tot_children'] == 'Two'){ echo 'selected';}} ?>>Two</option>
                            <option value="Three" <?php if(isset($row['tot_children'])){ if($row['tot_children'] == 'Three'){ echo 'selected';}} ?>>Three</option>
                            <option value="Four and above" <?php if(isset($row['tot_children'])){ if($row['tot_children'] == 'Four and above'){ echo 'selected';}} ?>>Four and above</option>