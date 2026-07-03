
            
            <!-- widget grid -->
            <section id="widget-grid" class="">

                <!-- row -->
                <div class="row">
                    
                    <div class="col-sm-6 col-md-4 col-lg-2">
                        <a href="javascript:void(0)" class="dashboard-boxes">
                            <span class="owner_number"><?= $this->db->get_where('masjid')->num_rows(); ?></span>
                            <h2>Masjid</h2>
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-2">
                        <a href="javascript:void(0)" class="dashboard-boxes">
                            <span class="owner_number"><?= $this->db->get_where('ads')->num_rows(); ?></span>
                            <h2>Ads</h2>
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-2">
                        <a href="javascript:void(0)" class="dashboard-boxes">
                            <span class="owner_number"><?= $this->db->get_where('blog')->num_rows(); ?></span>
                            <h2>Blog</h2>
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-2">
                        <a href="javascript:void(0)" class="dashboard-boxes">
                            <span class="owner_number"><?= $this->db->get_where('user',array('role_id'=>1))->num_rows(); ?></span>
                            <h2>Imam</h2>
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-2">
                        <a href="javascript:void(0)" class="dashboard-boxes">
                            <span class="owner_number"><?= $this->db->get_where('user',array('role_id'=>2))->num_rows(); ?></span>
                            <h2>Mutwalli</h2>
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-2">
                        <a href="javascript:void(0)" class="dashboard-boxes">
                            <span class="owner_number"><?= $this->db->get_where('user',array('role_id'=>3))->num_rows(); ?></span>
                            <h2>Student</h2>
                        </a>
                    </div>
                    
                </div>

                <!-- end row -->

            </section>
            <!-- end widget grid -->

        </div>
        <!-- END MAIN CONTENT -->

    </div>
    <!-- END MAIN PANEL -->

    