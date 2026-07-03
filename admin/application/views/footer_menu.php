
    <link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap.min1.css"> 
    <link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap-iconpicker1.min.css">
    <style type="text/css">
        body {
            background-color: #fafafa;
        }
        
        ol.example li.placeholder:before {
            position: absolute;
        }
        
        .list-group-item > div {
            margin-bottom: 5px;
        }
    </style>
 
 
                <div class="panel-body" id="cont">
                	
                        <ul id="myList" class="sortableLists list-group">
                        	<?php 
					    $query = $this->db->get('footer_menu');                                  
					        if($query->num_rows() >0){
					        foreach($query->result() as $val){ ?>

                            <li class="list-group-item" data-text="Home" data-icon="fa-home" data-href="http://home.com">
                                <div><span class="txt"><?= $val->menu_name?></span>
                                    <div class="btn-group pull-right"> <a href="#" class="btn btn-danger btn-xs btnRemove">X</a> </div>
                                </div>
                            </li>
                              <?php  }}
					    ?>
                            
                            
                        </ul>
                    </div>
         
    <script src='<?=base_url()?>assets/js/jquery.min.js'></script>
    <script src='<?=base_url()?>assets/js/jquery-menu-editor.js'></script>
    <script src='<?=base_url()?>assets/js/bootstrap-iconpicker.min.js'></script>
    <script style="display: none;">
        jQuery(document).ready(function() {
            var iconPickerOpt = {
                cols: 5,
                footer: false
            };
            var options = {
                hintCss: {
                    'border': '1px dashed #13981D'
                },
                placeholderCss: {
                    'background-color': 'gray'
                },
                ignoreClass: 'btn',
                opener: {
                    active: true,
                    as: 'html',
                    close: '<i class="fa fa-minus"></i>',
                    open: '<i class="fa fa-plus"></i>',
                    openerCss: {
                        'margin-right': '10px'
                    },
                    openerClass: 'btn btn-success btn-xs'
                }
            };
            menuEditor('myList', {
                listOptions: options,
                iconPicker: iconPickerOpt,
                labelEdit: 'Edit',
                labelRemove: 'X'
            });
        });
    </script>
    <script style="display: none;">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-36251023-1']);
        _gaq.push(['_setDomainName', 'jqueryscript.net']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);
        })();
    </script>
 

