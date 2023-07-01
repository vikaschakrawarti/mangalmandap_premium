<script>
    function getXMLHTTP() {
        var xmlhttp=false;
        try{
          xmlhttp=new XMLHttpRequest();
        }
        catch(e){
            try{
                xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch(e){
                try{
                    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                }
                catch(e1){
                    xmlhttp=false;
                }
            }
        }
        return xmlhttp;
    }
    function getCurrencyCode(strURL){
        var req = getXMLHTTP();
        if (req) {
            //function to be called when state is changed
            req.onreadystatechange = function(){
                //when state is completed i.e 4
                if (req.readyState == 4) {
                    // only if http status is "OK"
                    if (req.status == 200){
                        document.getElementById('plandiv').innerHTML=req.responseText;
                    }else{
                        alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                    }
                }
            }
            req.open("GET", strURL, true);
            req.send(null);
        }
    }
</script>
<?php
    ob_start();
    include_once '../../databaseConn.php';
    $DatabaseCo = new DatabaseConn();
    include_once '../../lib/requestHandler.php';
    include_once '../../class/Config.class.php';
    $configObj = new Config();

    $matri_id=isset($_REQUEST['matri_id'])?$_REQUEST['matri_id']:0;

    if(isset($_REQUEST['save'])){
        $_SESSION['mid'] = $_POST['mid'];
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['address'] = $_POST['address'];
        $_SESSION['pay_mode'] = $_POST['pay_mode'];
        $_SESSION['activedt'] = $_POST['activedt'];
        $_SESSION['plan'] = $_POST['plan'];

        $_SESSION['chat'] = $_POST['chat'];
        $_SESSION['bankdet'] = $_POST['bankdet'];
        $_SESSION['duration'] = $_POST['duration'];
        $_SESSION['no_of_contacts'] = $_POST['no_of_contacts'];
        $_SESSION['no_of_msg'] = $_POST['no_of_msg'];
        $_SESSION['no_of_profile'] = $_POST['no_of_profile'];
        $_SESSION['amount'] = $_POST['amount'];
        header("location:paid_approved_process.php?id=$matri_id");
    }
    if($matri_id!=''){
        $sql=$DatabaseCo->dbLink->query("SELECT * FROM register_view WHERE matri_id='$matri_id'");
        $row=mysqli_fetch_object($sql);
?>
    <div class="md-content md-effect-13 inPaidModal" id="dialog" style="width:60% !important; margin-top:2%;">
        <div class="modal-header">
            <span id="new_button">
              <button class="md-close close" id="old"  data-dismiss="modal">&times;</button>
            </span>
            <h4 class="modal-title" id="myModalLabel">Approve Active To paid</h4>
        </div>
        <div class='error-msg' id='validationSummary'></div>
        <!--- Paid_approved_proccess.php -->
        <form method="post" id="plan_list" action="paid_approved_process" >
        <div class="modal-body">
            <div class="row">
                <div class="col-xs-12 col-lg-3 col-sm-4">
                    <div class="thumbnail">
                        <?php if($row->photo1!=''){ ?>
                            <img src="../my_photos/<?php echo $row->photo1; ?>">
                        <?php }else{ ?>
                        <?php 
                            if($row->gender == 'Female'){
                        ?>
                            <img src="../img/female.jpg" alt="User Image"/>
                        <?php }else{ ?>
                             <img src="../img/male.jpg" alt="User Image"/>	
                        <?php } ?>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-xs-12 col-lg-9 col-sm-8">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="inPaidModalMatri">
                                    <h3 class="text-primary"><?php echo $row->username; ?> (<?php echo $row->matri_id; ?>)</h3>
                                </label>
                            </div>
                            <div class="col-md-6 text-center">
                                <label class="inPaidModalStatus fw-600">
                                    <?php if($row->fstatus=='Featured'){ ?>
                                        <i class="fa fa-star mr-10 text-warning"></i><span class="hidden-xs">Featured</span>
                                    <?php } ?>
                                    <?php if($row->status=='Paid'){ ?>
                                        <i class="fa fa-money mr-10"></i><span class="hidden-xs">Paid</span>
                                    <?php }elseif($row->status=='Active'){ ?>
                                        <i class="fa fa-thumbs-up mr-10"></i><span class="hidden-xs">Active</span>
                                    <?php }elseif($row->status=='Inactive'){ ?>
                                        <i class="fa fa-thumbs-down text-danger mr-10"></i><span class="hidden-xs">Inactive</span>
                                    <?php }elseif($row->status=='Suspended'){?>
                                        <i class="fa fa-user-times text-danger"></i><span class="hidden-xs">Suspended</span>
                                    <?php } ?>
                                </label>
                            </div>
                        </div>
                        <div class="row mt-15">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            Country :
                                        </div>
                                        <div class="col-xs-7">
                                            <b class="fw-600"><?php echo $row->country_name; ?></b>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            State :
                                        </div>
                                        <div class="col-xs-7">
                                            <b class="fw-600"><?php echo $row->state_name; ?></b>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            City :
                                        </div>
                                        <div class="col-xs-7">
                                           <b class="fw-600"><?php echo $row->city_name; ?></b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            Gender :
                                        </div>
                                        <div class="col-xs-7">
                                            <b class="fw-600"><?php echo $row->gender; ?></b>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            Religion :
                                        </div>
                                        <div class="col-xs-7">
                                            <b class="fw-600"><?php echo $row->religion_name; ?></b>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            Caste :
                                        </div>
                                        <div class="col-xs-7">
                                            <b class="fw-600"><?php echo $row->caste_name; ?></b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
            <div class="row">
                <div class="col-xs-12 col-lg-6 col-sm-6">
                    <div class="row mt-10">
                        <div class="form-group form-group-select2">
                            <div class="col-xs-5 inPaidModalDetLable">
                                <label for="exampleInputEmail1">
                                    <b class="fw-600">Payment Mode :</b>
                                </label>
                            </div>
                            <div class="col-xs-7">
                                <select class="form-control" name="pay_mode" id="pay_mode">
                                    <option value="">Select Payment Mode</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Cheque">Cheque</option>
                                    <option value="Credit Card">Credit Card</option>
                                    <option value="DD">DD</option>
                                    <option value="Money Order">Money Order</option>
                                    <option value="Funds Transfer">Funds Transfer</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>	
                    <div class="row mt-10">
                        <div class="form-group form-group-select2">
                            <div class="col-xs-5 inPaidModalDetLable">
                                <label for="exampleInputEmail1">
                                    <b class="fw-600">Activation Date :</b>
                                </label>
                            </div>
                            <div class="col-xs-7">
                                <?php 
                                    $today1 = strtotime ('now');
                                    $today=date("Y-m-d",$today1); 
                                ?>
                                <input name="activedt" type="text"  id="activedt" value="<?php echo $today; ?>" class="form-control" />
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>	
                    <div class="row mt-10">
                        <div class="form-group form-group-select2">
                            <div class="col-xs-5 inPaidModalDetLable">
                                <label for="exampleInputEmail1">
                                    <b class="fw-600">Plan :</b>
                                </label>
                                <?php
                                    $plan = $DatabaseCo->dbLink->query("SELECT * FROM membership_plan");
                                ?>
                            </div>
                            <div class="col-xs-7">
                                <select name="plan" onChange="getCurrencyCode('findpay?plan='+this.value+'&id=<?php echo $row->matri_id;?>')" class="form-control" data-validetta="required">
                                    <option value="">Select Plan</option>
                                    <?php
                                        while($data = mysqli_fetch_object($plan)){ 
                                    ?> 
                                        <option value="<?php echo $data->plan_name;?>">
                                            <?php echo $data->plan_name;?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>	
                    <div class="row mt-10">
                        <div class="form-group form-group-select2">
                            <div class="col-xs-5 inPaidModalDetLable">
                                <label for="exampleInputEmail1">
                                    <b class="fw-600">Bank Detail :</b>
                                </label>
                            </div>
                            <div class="col-xs-7">   
                                <textarea name="bankdet" cols="30" rows="4"  id="bankdet" class="form-control"></textarea>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>	
                <!--- findpay.php page for this part --->
                <div class="col-xs-12 col-lg-6 col-sm-6" id="plandiv"></div>
                <!--- findpay.php page for this part --->
            </div>
        </div>
        <div class="inPaidModalFooter updateSite text-center">
            <input type="submit" name="save"  class="btn btn-success" value="Proceed" />
            <input type="hidden" name="keyword_id" id="keyword_id" value=""/>
            <input type="hidden" name="action" value="" id="update_action"/>
            <input name="mid" type="hidden" id="mid" value="<?php echo $row->matri_id;?>" />
            <input name="name" type="hidden" id="name" value="<?php echo $row->username;?>" />
            <input name="email" type="hidden" id="email" value="<?php echo $row->email;?>" />
            <input name="address" type="hidden" id="address" value="<?php echo $row->address;?>" />
        </div>
        </form>
    </div>
    <div class="md-overlay"></div>
    <script type="text/javascript">
        $(function(){
            $('#plan_list').validetta({
                errorClose : false,
                realTime : true
            });
        });
    </script>
    <?php 
        }else{
            echo "<h1>Invalid User ID.</h1>";
        }
    ?>
