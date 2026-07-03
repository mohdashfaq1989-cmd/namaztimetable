<!-- MAIN CONTENT -->

        <div class="col-lg-10">
            <div class="ntt-color text-white p-3 rounded-4 mt-3 mb-4 d-flex justify-content-between align-items-center">

                <h4 class="mb-0"><?= $page_title?></h4>

                <button class="btn btn-light d-lg-none" onclick="toggleSidebar()">
                    <i class="fa fa-bars"></i>
                </button>

            </div>
            <form id="adForm" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="row">                 
                   
            <div class="col-sm-8">
            <div class="form-group row">
                
                <input type="hidden" name="created_by" value="<?= $userData->id;?>" />

                
                <div class="col-sm-12">
                    <label for="masjid_id" class="col-form-label">Masjid</label>
                    <select id="masjid_id" name="masjid_id" class="form-control" required/>
                        <option value="">Select Masjid</option>
                        <?php $query = $this->db->order_by('name', 'ASC')->get_where('masjid'); if($query->num_rows() >0){ foreach($query->result() as $val){ ?>
                        <option value="<?php echo $val->id;?>"><?php echo $val->name;?></option>
                     <?php  }} ?>
                    </select>
                </div>
                <div class="col-sm-12">
                    <label for="name" class="col-form-label">Ad Title</label>
                    <input name="title" class="form-control" type="text" placeholder="Ad Title" value="" />
                </div> 
                
                <div class="col-sm-12">
                    <label for="description" class="col-form-label">Description</label>
                    <textarea rows="10" name="description" placeholder="Description" class="form-control" id="description"></textarea>
                </div>
                
                
            </div>
            <div class="form-group row">    
                <div class="col-sm-12"><br>
                    <label for="preview" class="col-sm-3 col-form-label">Image Preview</label>
                    <img id="blah" src="assets/img/default.jpg" class="img-thumbnail" width="80" height="80">
                </div>
                <input type="hidden" name="old_image" value="">
            </div>
            <div class="form-group row">        
                <div class="col-sm-12">
                    <label for="image" class="col-sm-3 col-form-label">Ad Image</label>
                    <input type="file" name="image" id="image" aria-describedby="fileHelp" />
                    <small id="fileHelp" class="text-muted"></small>
                </div>
            </div> 
            <div class="form-group row"> 
                <div class="col-sm-9">
                <button type="submit" id="submit" class="btn btn-primary w-md m-b-5"><span id="load"></span>Add</button>
                <br>
                <p id="update_msg" class="text-success" ></p>
                </div>
            </div>
        </div>
        
        </div>
    </form>

          </div>
        </div>

      </div>

     
    
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
        
        $('#adForm').on('submit', function(e){  
            e.preventDefault();
            //var doc_id = $('#doc_id').val();
            var formData = new FormData(this); 
            console.log('fd',formData);
            //formData.append('doc', CKEDITOR.instances['editor'].getData());
            $.ajax({    
                     url:"<?php echo base_url(); ?>user/insertAd/",    
                     method:"POST",  
                     data:formData,  
                     beforeSend: function() {
                        $('#submit').attr('disabled', true);
                        $('#load').html('<img src="./assets/img/loading.gif" style="width:30px;" />');
                    },
                     contentType: false,  
                     cache: false,  
                     processData:false,  
                     dataType: "json",
                     success:function(response)  
                     {  
                        console.log(response)
                        if(response['status']==1){ 
                            $('#update_msg').html('Added successfully').css('color','green');
                            setTimeout(function(){
                                $('#update_msg').html('');
                                window.location.replace('user/masjidAdList');
                            },1000)
                        }
                        
                        
                         
                }
          
            });  
        });
                
	});	
		 
	</script>


  

  