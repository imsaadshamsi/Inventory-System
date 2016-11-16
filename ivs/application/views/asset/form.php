<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Asset Details</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <ul class="breadcrumb">
          <li><?php echo anchor('/asset/index', 'Assets'); ?></li>
          <?php if($mode=='edit') {?>
          <li class="active">Edit Asset</li>
          <?php } else if($mode=='new')  {?>
          <li class="active">New Asset</li>
          <?php } ?>
    </ul>

    <div class="jumbotron" style="padding-left: 20px;">
      
      <?php
       $this->load->helper('form');
       echo form_open($action,array('role'=>'form'));
       echo '<input type="hidden" id="assetid" name="assetid" value="'. $assetDO->getAsset_id() . '" />';
       if (isset($msg) && strlen($msg) > 0) {
        if (strcmp($msgType,'error') == 0) {
         echo '<div class="alert alert-dismissable alert-danger">';
        }
        elseif (strcmp($msgType,'success') == 0) {
         echo '<div class="alert alert-dismissable alert-success">';
        }
        else {
         echo '<div class="alert alert-dismissable alert-info">';
        }
        echo $msg.validation_errors().'</div>';
       } 
      ?>






      <div class="form-group">
       <label for="ptagcode">Ptag Code</label>
        <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $assetDO->getPtag_code(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="ptagcode" name="ptagcode" value="<?php echo $assetDO->getPtag_code(); ?>" placeholder="Enter Ptag Code" required="required"/>
        <?php } ?>
      </div>


      <div class="form-group">
       <label for="otagcode">Otag Code</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $assetDO->getOtag_code(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="otagcode" name="otagcode" value="<?php echo $assetDO->getOtag_code(); ?>" placeholder="Enter Otag Code" required="required"/>
       <?php } ?>
      </div>

      <div class="form-group">
       <label for="commcode">Comm Code</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $assetDO->getComm_code(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="commcode" name="commcode" value="<?php echo $assetDO->getComm_code(); ?>" placeholder="Enter comm Code" required="required"/>
       <?php } ?>
      </div>

        <div class="form-group">
       <label for="assetdescr">Asset Descr</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $assetDO->getAsset_descr(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="assetdescr" name="assetdescr" value="<?php echo $assetDO->getAsset_descr(); ?>" placeholder="Enter asset descr" required="required"/>
       <?php } ?>
      </div>


            <div class="form-group">
       <label for="serialnum">Serial num</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $assetDO->getSerial_num(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="serialnum" name="serialnum" value="<?php echo $assetDO->getSerial_num(); ?>" placeholder="Enter Serial num" required="required"/>
       <?php } ?>
      </div>

       <div class="form-group">
       <label for="pohdcode">Pohd code</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $assetDO->getPohd_code(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="pohdcode" name="pohdcode" value="<?php echo $assetDO->getPohd_code(); ?>" placeholder="Enter Pohd code" required="required"/>
       <?php } ?>
      </div>

            <div class="form-group">
       <label for="stat">stat</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $assetDO->getAcct_title(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="stat" name="stat" value="<?php echo $assetDO->getAcct_title(); ?>" placeholder="Enter stat" required="required"/>
       <?php } ?>
      </div>

      <div class="form-group">
       <label for="origdoccode">Orig Doc code</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $assetDO->getOrig_doc_code(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="origdoccode" name="origdoccode" value="<?php echo $assetDO->getOrig_doc_code(); ?>" placeholder="Enter Orig Doc code" required="required"/>
       <?php } ?>
      </div>

      <div class="form-group">
       <label for="activedate">Active Date</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $assetDO->getActive_date(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="activedate" name="activedate" value="<?php echo $assetDO->getActive_date(); ?>" placeholder="Enter Active Date" required="required"/>
       <?php } ?>
      </div>

            <div class="form-group">
       <label for="cap">Cap</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $assetDO->getCap(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="cap" name="cap" value="<?php echo $assetDO->getCap(); ?>" placeholder="Enter Orig Doc code" required="required"/>
       <?php } ?>
      </div>

            <div class="form-group">
       <label for="capdate">Cap date</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $assetDO->getCap_date(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="capdate" name="capdate" value="<?php echo $assetDO->getCap_date(); ?>" placeholder="Enter Cap Date" required="required"/>
       <?php } ?>
      </div>

            <div class="form-group">
       <label for="orgnresp">Orgn resp</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $assetDO->getOrgn_resp(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="orgnresp" name="orgnresp" value="<?php echo $assetDO->getOrgn_resp(); ?>" placeholder="Enter Orgn resp" required="required"/>
       <?php } ?>
      </div>

            <div class="form-group">
       <label for="fund">Fund</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $assetDO->getFund(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="fund" name="fund" value="<?php echo $assetDO->getFund(); ?>" placeholder="Enter Fund" required="required"/>
       <?php } ?>
      </div>


            <div class="form-group">
       <label for="orgn">Orgn</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $assetDO->getOrgn(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="orgn" name="orgn" value="<?php echo $assetDO->getOrgn(); ?>" placeholder="Enter Orgn" required="required"/>
       <?php } ?>
      </div>

            <div class="form-group">
       <label for="locnresp">locnresp</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $assetDO->getLocn_resp(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="locnresp" name="locnresp" value="<?php echo $assetDO->getLocn_resp(); ?>" placeholder="Enter locnresp" required="required"/>
       <?php } ?>
      </div>

            <div class="form-group">
       <label for="netbkvalue">netbkvalue</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $assetDO->getNet_bk_value(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="netbkvalue" name="netbkvalue" value="<?php echo $assetDO->getNet_bk_value(); ?>" placeholder="Enter netbkvalue" required="required"/>
       <?php } ?>
      </div>

            <div class="form-group">
       <label for="acct">acct</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $assetDO->getAcct(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="acct" name="acct" value="<?php echo $assetDO->getAcct(); ?>" placeholder="Enter acct" required="required"/>
       <?php } ?>
      </div>

            <div class="form-group">
       <label for="accttitle">accttitle</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $assetDO->getAcct_title(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="accttitle" name="accttitle" value="<?php echo $assetDO->getAcct_title(); ?>" placeholder="Enter accttitle" required="required"/>
       <?php } ?>
      </div>


      


      <button type="submit" class="btn btn-success"><?php echo $btnLabel; ?></button>
      </form>

      <div class="app-form-nav-links" style="float:right">
       <?php echo anchor($backAction, 'Back', array('class'=>'btn btn-primary','role'=>'button')); ?>
       <?php echo anchor('/asset/export/' . $assetDO->getAsset_id(), 'Export', array('class'=>'btn btn-warning','role'=>'button')); ?>
       
      </div>



    </div>
    <!-- /.jumbotron-->

</div>
<!-- /#page-wrapper -->