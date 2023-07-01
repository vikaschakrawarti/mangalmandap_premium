<?php
    include_once '../../databaseConn.php';
    include_once '../../lib/requestHandler.php';
    $DatabaseCo = new DatabaseConn();

    $matri_id = $_SESSION['user_id'] ? $_SESSION['user_id'] : '';

    $SQLSTATEMENT = $DatabaseCo->dbLink->query("SELECT email,m_tongue,firstname,lastname,m_tongue,mobile,mobile_code,m_tongue,m_status,tot_children,status_children,profileby,gender FROM register WHERE matri_id='$matri_id'");
    $DatabaseCo->dbRow = mysqli_fetch_object($SQLSTATEMENT);

    $email = isset($DatabaseCo->dbRow->email) ? $DatabaseCo->dbRow->email : "";
    $m_tongue = isset($DatabaseCo->dbRow->m_tongue) ? $DatabaseCo->dbRow->m_tongue : "";
?>
<div class="gt-panel-head">
    <span class="pull-left"><i class="fa fa-file"></i><?php echo $lang['Basic Details']; ?></span>
    <a class="pull-right btn gt-btn-orange" onClick="return view11('edit');">
        <i class="fa fa-pencil-alt"></i><font class="gt-margin-left-5"><?php echo $lang['SUBMIT']; ?></font>
    </a>
	<a href="#myModal" data-toggle="modal" class="pull-right btn gt-btn-orange gt-margin-right-5">
        <i class="fa fa-pencil-alt"></i><font class="gt-margin-left-5"><?php echo $lang['EDIT MOBILE NO']; ?></font>
    </a>
</div>
<div class="gt-panel-body">
    <form  method="post" name="reg_edit_1" id="reg_edit_1">
        <div class="row">
            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pb-10 pt-10 gt-view-detail">
                <label>
                    <span class="text-danger mr-5 gtRegMandatory">*</span><?php echo $lang['First Name']; ?>:
                </label>
                <input type="text" class="gt-form-control" name="first_name" value="<?php echo isset($DatabaseCo->dbRow->firstname) ? $DatabaseCo->dbRow->firstname : ""; ?>" data-validetta="required">
            </div>
            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pb-10 pt-10 gt-view-detail">
                <label>
                     <span class="text-danger mr-5 gtRegMandatory">*</span><?php echo $lang['Last Name']; ?>:
                </label>
                <input type="text" class="gt-form-control" name="sur_name" value="<?php echo isset($DatabaseCo->dbRow->lastname) ? $DatabaseCo->dbRow->lastname : ""; ?>" data-validetta="required">
            </div>
          
            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pb-10 pt-10 gt-view-detail">
                <div class="row">
                    <div class="col-xs-12">
                        <label> <span class="text-danger mr-5 gtRegMandatory">*</span><?php echo $lang['Profile Created By']; ?>:</label>
                    </div>
                </div>   
                <div class="row">
					<div class="col-xs-16">
                        <select class="gt-form-control" name="profileby" data-validetta="required">
							<option value="">Select</option>
							<?php
				                $SQL_STATEMENT_PROFILE_BY = $DatabaseCo->dbLink->query("SELECT * FROM profile_by WHERE status='APPROVED' ORDER BY id ASC");
 							    while ($row_profile_by = mysqli_fetch_object($SQL_STATEMENT_PROFILE_BY)) {
                            ?>
                            <option value="<?php echo $row_profile_by->id; ?>" <?php if(isset($DatabaseCo->dbRow->profileby)){ if($DatabaseCo->dbRow->profileby == $row_profile_by->profile_by){ echo 'selected';} }?>><?php echo $row_profile_by->profile_by; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pb-10 pt-10 gt-view-detail">
                <label>
                     <span class="text-danger mr-5 gtRegMandatory">*</span><?php echo $lang['Marital Status']; ?> :
                </label>
                <select class="gt-form-control" name="m_status" data-validetta="required" id="mat" onchange="val()">
                    <option value="Never Married" <?php if(isset($DatabaseCo->dbRow->m_status)){ if($DatabaseCo->dbRow->m_status == 'Never Married'){ echo 'selected'; }} ?>>Never Married</option>
                    <?php if($DatabaseCo->dbRow->gender == 'Male'){ ?>
                    <option value="Widower" <?php if(isset($DatabaseCo->dbRow->m_status)){ if($DatabaseCo->dbRow->m_status == 'Widower'){ echo 'selected';}} ?>>Widower</option>
                    <?php }else{ ?>
                    <option value="Widow" <?php if($DatabaseCo->dbRow->m_status == 'Widow'){ echo 'selected'; }  ?>>Widow</option>
                    <?php }?>
                    <option value="Divorced" <?php if(isset($DatabaseCo->dbRow->m_status)){ if($DatabaseCo->dbRow->m_status == 'Divorced'){ echo 'selected';}} ?>>Divorced</option>
                    <option value="Awaiting Divorce" <?php if(isset($DatabaseCo->dbRow->m_status)){ if($DatabaseCo->dbRow->m_status == 'Awaiting Divorce'){ echo 'selected';}} ?>>Awaiting Divorce</option>
                </select>
            </div>
            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pb-10 pt-10 gt-view-detail" id="marital_status">
                <label>
                    <?php echo $lang['No Of Children']; ?> :
                </label>
                <select class="gt-form-control"  name="tot_children" id="tot_children">
                    <option value="">Select</option>
                    <option value="No Child" <?php if(isset($DatabaseCo->dbRow->tot_children)){ if($DatabaseCo->dbRow->tot_children == 'No Child'){ echo 'selected';}} ?>>None</option>
                    <option value="One" <?php if(isset($DatabaseCo->dbRow->tot_children)){ if($DatabaseCo->dbRow->tot_children == 'One'){ echo 'selected';}} ?>>One</option>
                    <option value="Two" <?php if(isset($DatabaseCo->dbRow->tot_children)){ if($DatabaseCo->dbRow->tot_children == 'Two'){ echo 'selected';}} ?>>Two</option>
                    <option value="Three" <?php if(isset($DatabaseCo->dbRow->tot_children)){ if($DatabaseCo->dbRow->tot_children == 'Three'){ echo 'selected';}} ?>>Three</option>
                    <option value="Four and above" <?php if(isset($DatabaseCo->dbRow->tot_children)){ if($DatabaseCo->dbRow->tot_children == 'Four and above'){ echo 'selected';}} ?>>Four and above</option>
                </select>
            </div>
            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pb-10 pt-10 gt-view-detail" id="marital_status1">
                <label>
                    <?php echo $lang['Children Living Status']; ?>:
                </label>
                <select name="child_status" id="child_status" class="gt-form-control">
                	<option value="">Select</option>
                    <option value="Living with me" <?php if(isset($DatabaseCo->dbRow->status_children)){ if($DatabaseCo->dbRow->status_children == 'Living with me'){ echo 'selected';}} ?>>Living with me</option>
                    <option value="Not living with me" <?php if(isset($DatabaseCo->dbRow->status_children)){ if($DatabaseCo->dbRow->status_children == 'Not living with me'){ echo 'selected';}} ?>>Not living with me</option>    
                </select>
            </div>
            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pb-10 pt-10 gt-view-detail">
                <label>
                     <span class="text-danger mr-5 gtRegMandatory">*</span><?php echo $lang['Mother Tongue']; ?> :
                </label>
                <select class="gt-form-control chosen-select" name="m_tongue" data-validetta="required">
                    <option value="">Select Mother Tongue</option>	
                    <?php
                        $SQL_STATEMENT_Mtongu = $DatabaseCo->dbLink->query("SELECT mtongue_id,mtongue_name FROM mothertongue WHERE status='APPROVED' ORDER BY mtongue_name ASC");
                        while ($DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_Mtongu)) {
                    ?>
                    <option value="<?php echo $DatabaseCo->Row->mtongue_id; ?>" <?php if (isset($DatabaseCo->dbRow->m_tongue) && ($DatabaseCo->dbRow->m_tongue == $DatabaseCo->Row->mtongue_id)) { echo "selected" ;}?>>
                        <?php echo $DatabaseCo->Row->mtongue_name; ?>
                    </option>
                    <?php } ?>   
                </select>
            </div>

        </div>
    </form>   
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<form action="reverify-mobile-no" method="post" class="inMobileVerifyChange gt-search-opt" id="modalVerifymobile">
					<div class="row">
						<div class="col-xxl-16 text-center">
							<h4 class="fontMerriWeather"><?php echo $lang['Edit Mobile No']; ?></h4>
						</div>
						<div class="col-xxl-16 mt-20">
							<div class="form-group">
								<label><?php echo $lang['Mobile No']; ?></label>
								<div class="row">
									<div class="col-xxl-6">
										<select class="gt-form-control" name="code" data-validetta="required">
                                            <option value="+93">+93</option>
                                            <option value="+355">+355</option>
                                            <option value="+213">+213</option>
                                            <option value="+684">+684</option>
                                            <option value="+376">+376</option>
                                            <option value="+244">+244</option>
                                            <option value="+1">+1</option>
                                            <option value="+54">+54</option>
                                            <option value="+374">+374</option>
                                            <option value="+61">+61</option>
                                            <option value="+43">+43</option>
                                            <option value="+994">+994</option>
                                            <option value="+973">+973</option>
                                            <option value="+880">+880</option>
                                            <option value="+375">+375</option>
                                            <option value="+32">+32</option>
                                            <option value="+501">+501</option>
                                            <option value="+975">+975</option>
                                            <option value="+591">+591</option>
                                            <option value="+387">+387</option>
                                            <option value="+267">+267</option>
                                            <option value="+55">+55</option>
                                            <option value="+673">+673</option>
                                            <option value="+359">+359</option>
                                            <option value="+226">+226</option>
                                            <option value="+257">+257</option>
                                            <option value="+225">+225</option>
                                            <option value="+855">+855</option>
                                            <option value="+237">+237</option>
                                            <option value="+238">+238</option>
                                            <option value="+236">+236</option>
                                            <option value="+235">+235</option>
                                            <option value="+56">+56</option>
                                            <option value="+86">+86</option>
                                            <option value="+57">+57</option>
                                            <option value="+269">+269</option>
                                            <option value="+242">+242</option>
                                            <option value="+682">+682</option>
                                            <option value="+506">+506</option>
                                            <option value="+385">+385</option>
                                            <option value="+53">+53</option>
                                            <option value="+357">+357</option>
                                            <option value="+420">+420</option>
                                            <option value="+850">+850</option>
                                            <option value="+243">+243</option>
                                            <option value="+45">+45</option>
                                            <option value="+253">+253</option>
                                            <option value="+670">+670</option>
                                            <option value="+593">+593</option>
                                            <option value="+20">+20</option>
                                            <option value="+503">+503</option>
                                            <option value="+240">+240</option>
                                            <option value="+291">+291</option>
                                            <option value="+372">+372</option>
                                            <option value="+251">+251</option>
                                            <option value="+500">+500</option>
                                            <option value="+298">+298</option>
                                            <option value="+679">+679</option>
                                            <option value="+358">+358</option>
                                            <option value="+33">+33</option>
                                            <option value="+594">+594</option>
                                            <option value="+689">+689</option>
                                            <option value="+241">+241</option>
                                            <option value="+220">+220</option>
                                            <option value="+995">+995</option>
                                            <option value="+49">+49</option>
                                            <option value="+233">+233</option>
                                            <option value="+350">+350</option>
                                            <option value="+30">+30</option>
                                            <option value="+299">+299</option>
                                            <option value="+590">+590</option>
                                            <option value="+502">+502</option>
                                            <option value="+224">+224</option>
                                            <option value="+245">+245</option>
                                            <option value="+592">+592</option>
                                            <option value="+509">+509</option>
                                            <option value="+504">+504</option>
                                            <option value="+852">+852</option>
                                            <option value="+36">+36</option>
                                            <option value="+354">+354</option>
                                            <option value="+91" selected>+91</option>
                                            <option value="+62">+62</option>
                                            <option value="+98">+98</option>
                                            <option value="+964">+964</option>
                                            <option value="+353">+353</option>
                                            <option value="+972">+972</option>
                                            <option value="+39">+39</option>
                                            <option value="+81">+81</option>
                                            <option value="+962">+962</option>
                                            <option value="+7">+7</option>
                                            <option value="+254">+254</option>
                                            <option value="+686">+686</option>
                                            <option value="+82">+82</option>
                                            <option value="+965">+965</option>
                                            <option value="+996">+996</option>
                                            <option value="+856">+856</option>
                                            <option value="+371">+371</option>
                                            <option value="+961">+961</option>
                                            <option value="+266">+266</option>
                                            <option value="+231">+231</option>
                                            <option value="+218">+218</option>
                                            <option value="+423">+423</option>
                                            <option value="+370">+370</option>
                                            <option value="+352">+352</option>
                                            <option value="+853">+853</option>
                                            <option value="+261">+261</option>
                                            <option value="+265">+265</option>
                                            <option value="+60">+60</option>
                                            <option value="+960">+960</option>
                                            <option value="+223">+223</option>
                                            <option value="+356">+356</option>
                                            <option value="+596">+596</option>
                                            <option value="+222">+222</option>
                                            <option value="+230">+230</option>
                                            <option value="+269">+269</option>
                                            <option value="+52">+52</option>
                                            <option value="+691">+691</option>
                                            <option value="+373">+373</option>
                                            <option value="+377">+377</option>
                                            <option value="+976">+976</option>
                                            <option value="+212">+212</option>
                                            <option value="+258">+258</option>
                                            <option value="+95">+95</option>
                                            <option value="+264">+264</option>
                                            <option value="+674">+674</option>
                                            <option value="+977">+977</option>
                                            <option value="+31">+31</option>
                                            <option value="+599">+599</option>
                                            <option value="+687">+687</option>
                                            <option value="+64">+64</option>
                                            <option value="+505">+505</option>
                                            <option value="+227">+227</option>
                                            <option value="+234">+234</option>
                                            <option value="+683">+683</option>
                                            <option value="+672">+672</option>
                                            <option value="+47">+47</option>
                                            <option value="+968">+968</option>
                                            <option value="+92">+92</option>
                                            <option value="+507">+507</option>
                                            <option value="+675">+675</option>
                                            <option value="+595">+595</option>
                                            <option value="+51">+51</option>
                                            <option value="+63">+63</option>
                                            <option value="+672">+672</option>
                                            <option value="+48">+48</option>
                                            <option value="+351">+351</option>
                                            <option value="+974">+974</option>
                                            <option value="+262">+262</option>
                                            <option value="+40">+40</option>
                                            <option value="+7">+7</option>
                                            <option value="+250">+250</option>
                                            <option value="+290">+290</option>
                                            <option value="+508">+508</option>
                                            <option value="+685">+685</option>
                                            <option value="+378">+378</option>
                                            <option value="+239">+239</option>
                                            <option value="+966">+966</option>
                                            <option value="+221">+221</option>
                                            <option value="+381">+381</option>
                                            <option value="+248">+248</option>
                                            <option value="+232">+232</option>
                                            <option value="+65">+65</option>
                                            <option value="+421">+421</option>
                                            <option value="+386">+386</option>
                                            <option value="+677">+677</option>
                                            <option value="+252">+252</option>
                                            <option value="+27">+27</option>
                                            <option value="+34">+34</option>
                                            <option value="+94">+94</option>
                                            <option value="+249">+249</option>
                                            <option value="+597">+597</option>
                                            <option value="+268">+268</option>
                                            <option value="+46">+46</option>
                                            <option value="+41">+41</option>
                                            <option value="+963">+963</option>
                                            <option value="+886">+886</option>
                                            <option value="+992">+992</option>
                                            <option value="+255">+255</option>
                                            <option value="+66">+66</option>
                                            <option value="+389">+389</option>
                                            <option value="+228">+228</option>
                                            <option value="+690">+690</option>
                                            <option value="+676">+676</option>
                                            <option value="+216">+216</option>
                                            <option value="+90">+90</option>
                                            <option value="+993">+993</option>
                                            <option value="+688">+688</option>
                                            <option value="+256">+256</option>
                                            <option value="+380">+380</option>
                                            <option value="+971">+971</option>
                                            <option value="+44">+44</option>
                                            <option value="+598">+598</option>
                                            <option value="+998">+998</option>
                                            <option value="+678">+678</option>
                                            <option value="+58">+58</option>
                                            <option value="+84">+84</option>
                                            <option value="+681">+681</option>
                                            <option value="+967">+967</option>
                                            <option value="+381">+381</option>
                                            <option value="+260">+260</option>
                                            <option value="+263">+263</option>
                                            <option value="+297">+297</option>
                                            <option value="+229">+229</option>
                                            <option value="+599">+599</option>
                                            <option value="+246">+246</option>
                                            <option value="+599">+599</option>
                                            <option value="+379">+379</option>
                                            <option value="+692">+692</option>
                                            <option value="+680">+680</option>
                                            <option value="+970">+970</option>
                                            <option value="+590">+590</option>
                                            <option value="+590">+590</option>
                                            <option value="+211">+211</option>
                                            <option value="+670">+670</option>
                                            <option value="+382">+382</option>
										</select>
									</div>
									<div class="col-xxl-10">
										<input type="text" class="gt-form-control" name="change_mobile" placeholder="<?php echo $lang['Enter Mobile No']; ?>" data-validetta="required">
									</div>
								</div>
							</div>
						</div>
						<div class="col-xxl-16 text-center">
							<div class="form-group">
								<input type="submit" class="btn gt-btn-orange gt-margin-top-5" name="changeMobile" class="gt-form-control" value="<?php echo $lang['Submit']; ?>">
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Jquery Js-->
<script type="text/javascript">
	var config = {
    	'.chosen-select': {},
    	'.chosen-select-deselect': {allow_single_deselect: true},
       	'.chosen-select-no-single': {disable_search_threshold: 10},
       	'.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
        '.chosen-select-width': {width: "100%"}
    }
    for (var selector in config) {
    	$(selector).chosen(config[selector]);
   	}			
</script>
<script>
	<?php if($DatabaseCo->dbRow->m_status != 'Never Married' ){ ?>
	   	$(document).ready(function() {
			$('#marital_status').show();
			$('#marital_status1').show();
		});
    <?php }else{ ?>
        $(document).ready(function() {
            $('#marital_status').hide();
            $('#marital_status1').hide();
        }); 
    <?php  } ?>
	function val() {
    	d = document.getElementById("mat").value;
    	if (d == 'Never Married'){
            $('#marital_status').hide();
			$('#marital_status1').hide();
        }else{
			$('#marital_status').show();
			$('#marital_status1').show();
		}
	}
</script>
<script type="text/javascript" src="./js/validetta.js"></script>                
<script type="text/javascript">
    function view11(status) {
        $(function() {
            $('#reg_edit_1').validetta({
                errorClose: false,
                onValid: function(event) {
                    event.preventDefault();
                    view1(status);
                }
            });
        });
        $('#reg_edit_1').submit();
    }
    $(function(){
        $('#modalVerifymobile').validetta({
            errorClose : false,
            realTime : true
        });
    });	
</script>