
                            <option value="No Child" <?php if(isset($DatabaseCo->dbRow->tot_children)){ if($DatabaseCo->dbRow->tot_children == 'No Child'){ echo 'selected';}} ?>>None</option>
                            <option value="One" <?php if(isset($DatabaseCo->dbRow->tot_children)){ if($DatabaseCo->dbRow->tot_children == 'One'){ echo 'selected';}} ?>>One</option>
                            <option value="Two" <?php if(isset($DatabaseCo->dbRow->tot_children)){ if($DatabaseCo->dbRow->tot_children == 'Two'){ echo 'selected';}} ?>>Two</option>
                            <option value="Three" <?php if(isset($DatabaseCo->dbRow->tot_children)){ if($DatabaseCo->dbRow->tot_children == 'Three'){ echo 'selected';}} ?>>Three</option>
                            <option value="Four and above" <?php if(isset($DatabaseCo->dbRow->tot_children)){ if($DatabaseCo->dbRow->tot_children == 'Four and above'){ echo 'selected';}} ?>>Four and above</option>