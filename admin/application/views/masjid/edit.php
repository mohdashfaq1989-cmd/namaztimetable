
<script src="<?php echo base_url()  ?>assets/ckeditor/ckeditor.js"></script> 
<script src="<?php echo base_url()  ?>assets/ckeditor/sample.js"></script>
            <!-- widget grid -->
            <section id="widget-grid" class="transaction-page">

                <!-- row -->
                <div class="row" id="documentEdit">

                    <!-- NEW WIDGET START -->
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">



                        <!-- Widget ID (each widget will need unique ID)-->
                        <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-"
                            data-widget-editbutton="false">
                            <header><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                                <span class="widget-icon"> <i class="fa fa-cogs"></i> </span>
                                <h2><?= $page_title; ?></h2>

                            </header>

                            <!-- widget div-->
                            <div>
                                <!-- widget content -->
                                <div class="widget-body">
                                    <form id="insertUserData" enctype="multipart/form-data" method="post" accept-charset="utf-8">
<div class="row">                 
                   
            <div class="col-sm-8">
    <input type="hidden" name="masjid_id" value="<?php echo !empty($dbData['id'])?$dbData['id']:''; ?>" />

    <div class="form-group row"> 
    <div class="col-sm-12">
            <label for="name" class="col-form-label">Masjid Code</label>
            <input name="masjidCode" class="form-control" type="text" placeholder="Masjid Code" value="<?php echo !empty($dbData['masjidCode'])?$dbData['masjidCode']:''; ?>" />
        </div>
        <div class="col-sm-6">
            <label for="name" class="col-form-label">Masjid Name</label>
            <input name="name" class="form-control" type="text" placeholder="Masjid Name" value="<?php echo !empty($dbData['name'])?$dbData['name']:''; ?>" />
        </div>
        <div class="col-sm-6">
            <label for="ward_village" class="col-form-label">Name of Village</label>
            <input name="ward_village" class="form-control" type="text" placeholder="Ward No / Village Name" value="<?php echo !empty($dbData['ward_village'])?$dbData['ward_village']:''; ?>" />
        </div>
        <div class="col-sm-12">
            <label for="name" class="col-form-label">Address</label>
            <textarea name="address" placeholder="Address" class="form-control" ><?php echo !empty($dbData['address'])?$dbData['address']:''; ?></textarea>
        </div>
        <div class="col-sm-6">
            <label for="name" class="col-form-label">Imam Name </label>
            <input name="imam" class="form-control" type="text" placeholder="Imam Name" value="<?php echo !empty($dbData['imam'])?$dbData['imam']:''; ?>" />
        </div>
        <div class="col-sm-6">
            <label for="name" class="col-form-label">Imam Mobile</label>
            <input name="imamPhone" class="form-control" type="text" placeholder="Imam Mobile" value="<?php echo !empty($dbData['imamPhone'])?$dbData['imamPhone']:''; ?>" />
        </div>
        <div class="col-sm-6">
            <label for="name" class="col-form-label">Mutwalli Name</label>
            <input name="mutwalli" class="form-control" type="text" placeholder="Mutwalli Name" value="<?php echo !empty($dbData['mutwalli'])?$dbData['mutwalli']:''; ?>" />
        </div>
        <div class="col-sm-6">
            <label for="name" class="col-form-label">Mutwalli Mobile</label>
            <input name="mutwalliPhone" class="form-control" type="text" placeholder="Mutwalli Mobile" value="<?php echo !empty($dbData['mutwalliPhone'])?$dbData['mutwalliPhone']:''; ?>" />
        </div>
        <div class="col-sm-6">
            <label for="name" class="col-form-label">Student Name (20+)</label>
            <input name="student" class="form-control" type="text" placeholder="Student Name" value="<?php echo !empty($dbData['student'])?$dbData['student']:''; ?>" />
        </div>
        <div class="col-sm-6">
            <label for="name" class="col-form-label">Student Mobile</label>
            <input name="studentPhone" class="form-control" type="text" placeholder="Student Mobile" value="<?php echo !empty($dbData['studentPhone'])?$dbData['studentPhone']:''; ?>" />
        </div>
        <div class="col-sm-6">
            <label for="lng" class="col-form-label">Longitude</label>
            <input name="lng" class="form-control" type="text" placeholder="Longitude" value="<?php echo !empty($dbData['lng'])?$dbData['lng']:''; ?>" />
        </div>
        <div class="col-sm-6">
            <label for="lat" class="col-form-label">Latitude</label>
            <input name="lat" class="form-control" type="text" placeholder="Latitude" value="<?php echo !empty($dbData['lat'])?$dbData['lat']:''; ?>" />
        </div>
        
        <div class="col-sm-6">
            <label for="country_id" class="col-form-label">Country</label>
            <select id="country_id" name="country_id" class="form-control" required/>
                <option value="">Select country</option>
                <?php $query = $this->db->order_by('country_name', 'ASC')->get_where('countries'); if($query->num_rows() >0){ foreach($query->result() as $val){ ?>
                    <option value="<?php echo $val->country_id;?>" <?php if($dbData['country_id']==$val->country_id){echo'selected';} ?>><?php echo $val->country_name;?></option>
                    <?php  }} ?>
            </select>
        </div>
        <div class="col-sm-6">
            <label for="name" class="col-form-label">State</label>
            <select id="state_id" name="state_id" class="form-control">
                <?php  $query = $this->db->get_where('states'); if($query->num_rows() >0){ foreach($query->result() as $val){ ?>
                <option value="<?php echo $val->state_id;?>" <?php if($dbData['state_id']==$val->state_id){echo'selected';} ?>><?php echo $val->state_name;?></option>
                <?php }} ?>
            </select>
        </div>
        <div class="col-sm-6">
            <label for="name" class="col-form-label">District</label>
            <select id="city_id" name="city_id" class="form-control">
                <?php 
                    $query = $this->db->get_where('cities', array('state_id' =>$dbData['state_id'])); if($query->num_rows() >0){ foreach($query->result() as $val){ ?>
                    <option value="<?php echo $val->city_id;?>" <?php if($dbData['city_id']==$val->city_id){echo'selected';} ?>><?php echo $val->city_name;?></option>
                    <?php }} ?>
            </select>
        </div>
        <div class="col-sm-6">
            <label for="name" class="col-form-label">Tehsil</label>
            <select id="tehsil_id" name="tehsil_id" class="form-control">
            <?php $query = $this->db->get_where('tehsil', array('city_id' =>$dbData['city_id'])); if($query->num_rows() >0){ foreach($query->result() as $val){ ?>
                <option value="<?php echo $val->tehsil_id;?>" <?php if($dbData['tehsil_id']==$val->tehsil_id){echo'selected';} ?>><?php echo $val->tehsil_name;?></option>
                <?php }} ?>
            </select>
        </div>
        <div class="col-sm-6">
            <label for="name" class="col-form-label">RTO Code</label>
            <select id="rto_id" name="rto_id" class="form-control">
            <?php $query = $this->db->get_where('rto', array('city_id' =>$dbData['city_id'])); if($query->num_rows() >0){ foreach($query->result() as $val){ ?>
                <option value="<?php echo $val->rto_id;?>" <?php if($dbData['rto_id']==$val->rto_id){echo'selected';} ?>><?php echo $val->rto_name;?></option>
                <?php }} ?>
            </select>
        </div>
        
        <div class="col-sm-6">
            <label for="pincode" class="col-form-label">Pincode</label>
            <input name="pincode" class="form-control" type="text" placeholder="Pincode" value="<?php echo !empty($dbData['pincode'])?$dbData['pincode']:''; ?>" />
        </div>
        <div class="col-sm-12">
            <label for="description" class="col-form-label">Description</label>
            <textarea name="description" placeholder="Description" class="form-control" rows="6"><?php echo !empty($dbData['description'])?$dbData['description']:''; ?></textarea>
        </div>
 </div>
<div class="form-group row">
    <label for="preview" class="col-sm-3 col-form-label">Preview</label>
    <div class="col-sm-9">
        <img id="blah" src="<?php if(!$dbData['image']==""){echo '../uploads/images/'.$dbData['image'];}else{echo '../assets/img/default.jpg';}?>" class="img-thumbnail" width="125" height="100">
    </div>
    <input type="hidden" name="old_image" value="">
</div>
    <div class="form-group row">
        <label for="image" class="col-sm-3 col-form-label">Image</label>
        <div class="col-sm-9">
            <input type="file" name="image" id="image" aria-describedby="fileHelp" />
            <small id="fileHelp" class="text-muted"></small>
        </div>
    </div> 
 <div class="form-group row">
        <label for="status" class="col-sm-3 col-form-label">Status </label>
        <div class="col-sm-9">
            <label class="radio-inline">
                <input type="radio" name="status" value="1" id="status" <?php if($dbData['status']==1){echo'checked';} ?>/>
                Active
            </label>
            <label class="radio-inline">
                <input type="radio" name="status" value="0" id="status" <?php if($dbData['status']==0){echo'checked';} ?>/>
                Inactive
            </label>
        </div>
    </div>
    <div class="form-group row"> 
        <label for="created_by" class="col-sm-3 col-form-label">Assign User</label>
        <div class="col-sm-9">
            
            <select name="created_by" class="form-control" required/>
                <option value="">Select User</option>
                <?php $query = $this->db->order_by('name', 'ASC')->get_where('user'); if($query->num_rows() >0){ foreach($query->result() as $val){ ?>
                    <option value="<?php echo $val->id;?>" <?php if($dbData['created_by']==$val->id){echo'selected';} ?>><?php echo $val->name;?></option>
                    <?php  }} ?>
            </select>
        </div>
    </div>
    <div class="form-group row"> 
        <div class="col-sm-9">
        <button type="submit" id="submit" class="btn btn-primary w-md m-b-5"><span id="load"></span>Submit</button>
        <br>
        <p id="update_msg" class="text-success" ></p>
        </div>
    </div>
    </div>
        <div class="col-sm-4 namazTab">
            <h4>Namaz Time</h4>
            <div class="row">
                <label class="col-sm-3 col-form-label">Fajr</label>
                <div class="col-sm-9">                    
                    <input name="fajr" class="form-control" type="time" value="<?= date('H:i', strtotime($dbData['fajr'])) ?>"/>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3 col-form-label">Dhuhr</label>
                <div class="col-sm-9">                    
                    <input name="dhuhr" class="form-control" type="time" value="<?= date('H:i', strtotime($dbData['dhuhr'])) ?>"/>
                </div>
            </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Asr</label>
                <div class="col-sm-9">                    
                    <input name="asr" class="form-control" type="time" value="<?= date('H:i', strtotime($dbData['asr'])) ?>"/>
                </div>
            </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">Maghrib</label>
                <div class="col-sm-9">                    
                    <input name="maghrib" class="form-control" type="time" value="<?= date('H:i', strtotime($dbData['maghrib'])) ?>"/>
                </div>
            </div>
            <div class="row">
                    <label class="col-sm-3 col-form-label">Isha</label>
                    <div class="col-sm-9">
                    <input name="isha" class="form-control" type="time" value="<?= date('H:i', strtotime($dbData['isha'])) ?>"/>
                </div>
            </div>
             
            <div class="row">
                    <label class="col-sm-3 col-form-label">Juma</label>
                <div class="col-sm-9">                    
                    <input name="juma" class="form-control" type="time" value="<?= date('H:i', strtotime($dbData['juma'])) ?>"/>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3 col-form-label">Eid</label>
                <div class="col-sm-9">                    
                    <input name="eid" class="form-control" type="time" value="<?= date('H:i', strtotime($dbData['eid'])) ?>"/>
                </div>
            </div>
        </div>
        </div>
</form>



                                </div>
                                <!-- end widget content -->
                            </div>
                            <!-- end widget div -->

                        </div>
                        <!-- end widget -->

                    </article>
                    <!-- WIDGET END -->

                </div>
                
                <div class="row">

                    <!-- NEW WIDGET START -->
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">


                        <!-- Widget ID (each widget will need unique ID)-->
                        

                    </article>
                    <!-- WIDGET END -->

                </div>

                <!-- end row -->

                <!-- end row -->

            </section>
            <!-- end widget grid -->

        </div>
        <!-- END MAIN CONTENT -->

    </div>
    <!-- END MAIN PANEL -->
    
    <script>
	$(document).ready(function(){
	      function readURL(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
              $('#blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]); // convert to base64 string
          }
        }
        
        $("#image").change(function() {
          readURL(this);
        });
        
        $('#insertUserData').on('submit', function(e){  
            e.preventDefault(); 
            //var doc_id = $('#doc_id').val();
            var formData = new FormData(this); 
            console.log('fd',formData);
            //formData.append('doc', CKEDITOR.instances['editor'].getData());
            $.ajax({    
                     url:"<?php echo base_url(); ?>masjid/edit_masjid/",    
                     method:"POST",  
                     data:formData,  
                     beforeSend: function() {
                        $('#submit').attr('disabled', true);
                        $('#load').html('<img src="./assets/images/loading.gif" style="width:30px;" />');
                    },
                     contentType: false,  
                     cache: false,  
                     processData:false,  
                     dataType: "json",
                     success:function(response)  
                     {  
                        console.log(response)
                        if(response['status']==1){
                            //alert()
                            $('#update_msg').html('Updated successfully').css('color','green');
                            setTimeout(function(){
                                $('#update_msg').html('');
                                window.location.replace('masjid');
                            },1000)
                        }
                        
                        
                         
                }
          
            });  
        });
        
                
                
            
                
	});	
		 
	</script> 

   <script>
    $(document).ready(function () {
        $("#country_id").change(function () {
            var country_id = $("#country_id").val();
            if (country_id != "") {
                $.ajax({
                    url: "<?php echo base_url(); ?>login/fetch_state",
                    method: "POST",
                    data: { country_id: country_id },
                    success: function (data) {
                        $("#state_id").html(data);
                    },
                });
            } else {
                $("#state_id").html('<option value="">Select State</option>');
            }
        });
        $("#state_id").change(function () {
            var state_id = $("#state_id").val();
            if (state_id != "") {
                $.ajax({
                    url: "<?php echo base_url(); ?>login/fetch_city",
                    method: "POST",
                    data: { state_id: state_id },
                    success: function (data) {
                        $("#city_id").html(data);
                    },
                });
            } else {
                $("#city_id").html('<option value="">Select District</option>');
            }
        });
        $("#city_id").change(function () {
            var city_id = $("#city_id").val();
            if (city_id != "") {
                $.ajax({
                    url: "<?php echo base_url(); ?>login/fetch_tehsil",
                    method: "POST",
                    data: { city_id: city_id },
                    success: function (data) {
                        $("#tehsil_id").html(data);
                    },
                });
            } else {
                $("#tehsil_id").html('<option value="">Select Tehsil</option>');
            }
        });
        $("#city_id").change(function () {
            var city_id = $("#city_id").val();
            if (city_id != "") {
                $.ajax({
                    url: "<?php echo base_url(); ?>login/fetch_rto",
                    method: "POST",
                    data: { city_id: city_id },
                    success: function (data) {
                        $("#rto_id").html(data);
                    },
                });
            } else {
                $("#rto_id").html('<option value="">Select RTO</option>');
            }
        });
    });
</script>

  

  