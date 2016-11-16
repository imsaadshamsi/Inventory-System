<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Inventory Details</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <div class="jumbotron" style="padding-left: 20px;">


      <table class="table">
        <caption><strong><?php echo $inventoryDO->getName() ?></strong></caption>
        <thead>
          <tr>
            <th></th>
            <th></th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>Stock Number</td>
            <td><?php echo $inventoryDO->getStocknumber(); ?></td>
          </tr>

          <tr>
            <td>Name</td>
            <td><?php echo $inventoryDO->getName(); ?></td>
          </tr>

          <tr>
            <td>Category</td>
            <td><?php $udo = null;

              while ($categorylist->hasMore()) {
                $udo = $categorylist->next($udo);
                if($inventoryDO->getCategoryid() == $udo->getCategoryid()) echo $udo->getCategory();
             
               }?></td>
          </tr>

           <tr>
            <td>Minimum Qty</td>
            <td><?php echo $inventoryDO->getMinimumquantity(); ?></td>
          </tr>

          <tr>
            <td>Available Qty</td>
            <td><?php echo $inventoryDO->getQuantityavailable(); ?></td>
          </tr>

          <tr>
            <td>Shelf</td>
            <td><?php   $i = 1;
             $udo = null;
             while ($shelvinglist->hasMore()) {
              $udo = $shelvinglist->next($udo);
              if($udo->getShelvingid() == $inventoryDO->getShelvingid()) echo $udo->getShelving() .'(' . $udo->getLocation() . ')';
            } ?></td>
          </tr>

          <tr>
            <td>Status</td>
            <td><?php echo $inventoryDO->getStatus(); ?></td>
          </tr>

          <tr>
            <td>Description</td>
            <td><?php echo $inventoryDO->getDescription(); ?></td>
          </tr>

          <tr>
            <td>Comments</td>
            <td><?php echo $inventoryDO->getComments(); ?></td>
          </tr>

          <tr>
            <td>Date Added</td>
            <td><?php echo $inventoryDO->getDateadded(); ?></td>
          </tr>


      </tbody>

      </table>

    </div>
    <!-- /.jumbotron-->

</div>
<!-- /#page-wrapper -->