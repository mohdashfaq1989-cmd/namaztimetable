
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

    <input type="hidden" name="id" value="" />

    <div class="form-group row">
        <label for="country_id" class="col-sm-3 col-form-label">Country</label>
        <div class="col-sm-9">
            <select id="country_id" name="country_id" class="form-control" required/>
                <option value="">Select country</option>
                    <?php $query = $this->db->order_by('country_name', 'ASC')->get_where('countries'); if($query->num_rows() >0){ foreach($query->result() as $val){ ?>
                <option value="<?php echo $val->country_id;?>"><?php echo $val->country_name;?></option>
                    <?php  }} ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="name" class="col-sm-3 col-form-label">State Name</label>
        <div class="col-sm-9">
            <select id="state_id" name="state_id" class="form-control" required/>
                <option value="">Select State</option>                        
            </select>
        </div>
    </div>
    
    <div class="form-group row">
        <label for="name" class="col-sm-3 col-form-label">District Name</label>
        <div class="col-sm-9"> 
            <select id="city_id" name="city_id" class="form-control" required/>
            <option selected="">Select District</option>
            </select>
        </div>

    </div>
    <div class="form-group row">
        <label for="name" class="col-sm-3 col-form-label">Tehsil Name</label>
        <div class="col-sm-9">
            <input name="tehsil_name" class="form-control" type="text" placeholder="Tehsil Name" id="tehsil_name"/>
        </div>
    </div>

    <div class="form-group row"> 
        <div class="col-sm-9">
        <button type="submit" id="submit" class="btn btn-primary w-md m-b-5"><span id="load"></span>Submit</button>
        <br>
        <p id="update_msg" class="text-success" ></p>
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
                     url:"<?php echo base_url(); ?>tehsil/add_tehsil/",    
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
                            $('#update_msg').html('Added successfully').css('color','green');
                            setTimeout(function(){
                                $('#update_msg').html('');
                                window.location.replace('tehsil');
                            },2000)
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
    });
</script>

  

  

  

  