
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
        <label for="masjid_id" class="col-sm-3 col-form-label">Masjid</label>
        <div class="col-sm-9">
            <select id="masjid_id" name="masjid_id" class="form-control" required/>
                <option value="">Select Masjid</option>
                    <?php $query = $this->db->order_by('name', 'ASC')->get_where('masjid'); if($query->num_rows() >0){ foreach($query->result() as $val){ ?>
                <option value="<?php echo $val->id;?>"><?php echo $val->name;?></option>
                    <?php  }} ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="name" class="col-sm-3 col-form-label">Ad Name</label>
        <div class="col-sm-9">
            <input name="title" class="form-control" type="text" placeholder="Ad Name" id="title" value="" />
        </div>
    </div>

    <div class="form-group row">
        <label for="description" class="col-sm-3 col-form-label">Description</label>
        <div class="col-sm-9">
            <textarea name="description" placeholder="Description" class="form-control" id="description" rows="6" ></textarea>
        </div>
    </div>

     
 
<div class="form-group row">
                        <label for="preview" class="col-sm-3 col-form-label">Preview</label>
                        <div class="col-sm-9">
                            <img id="blah" src="assets/images/default.jpg" class="img-thumbnail" width="125" height="100">
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
                <input type="radio" name="status" value="1" id="status" checked/>
                Active
            </label>
            <label class="radio-inline">
                <input type="radio" name="status" value="0" id="status" />
                Inactive
            </label>
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
                     url:"<?php echo base_url(); ?>ads/add_ads/",    
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
                                window.location.replace('ads');
                            },2000)
                        }
                        
                        
                         
                }
          
            });  
        });
        
                
                
            
                
	});	
		 
	</script> 

  

  