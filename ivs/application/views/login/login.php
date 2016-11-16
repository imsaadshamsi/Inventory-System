    <div class="container">
        <div class="row">

            <h1 class="page-header" style="text-align:center">Inventory System v 1.1 - 2015</h1>
            <h4 style="text-align:center">The University of the West Indies - Campus Libraries </h4>
            <img src="<?php echo base_url(); ?>assets/images/uwi_crest1.jpg" style="display: block;margin-left: auto;margin-right: auto; width: 80px; height: 100px" />

            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                            <?php
                             $this->load->helper('form');
                             echo form_open('main/verifyLogon',array('role'=>'form'));
                             if (isset($msg) && strlen($msg) > 0) {
                              echo '<div class="alert alert-danger">'. $msg . validation_errors().'</div>';
                             } 
                            ?>
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" id="username" name="username" type="text" autofocus required="required" />
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" id="userPassword" name="userPassword" type="password"  required="required" value="" />
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- /#wrapper -->

