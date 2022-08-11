<div style="margin:4px">
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">
  <h3 class="panel-title" style="text-align:left;">Pricing</h3>
</div>
<div class="panel-body" style="padding-top:16px;">
<form role="form" class="form-horizontal" id="frmmain">

<div class="container">
<div class="row">



  <div class="col-xs-3 col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <?php echo $Packages[0]->packagename ?></h3>
                </div>
                <div class="panel-body">
                    <div class="the-price">
                        <h1>
                            $<?php echo $Packages[0]->price ?></h1>
                       
                    </div>
                    <table class="table">
                        <tbody><tr>
                            <td><b><?php echo $Packages[0]->packagedesc ?></b></td>
                        </tr>
                        <tr class="active">
                            <td><?php echo $Packages[0]->info1 ?>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><?php echo $Packages[0]->info2 ?>&nbsp;</td>
                        </tr>
                        <tr class="active">
                           <td><?php echo $Packages[0]->info3 ?>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><?php echo $Packages[0]->info4 ?>&nbsp;</td>
                        </tr>
                       
                    </tbody></table>
                </div>
                <div class="panel-footer">
                    <a role="button" style="width:100px" class="btn btn-primary" href="<?php echo $Packages[0]->link ?>"><?php echo $ButtonCaption ?></a>
                    </div>
            </div>
        </div>
  
  <div class="col-xs-3 col-md-3">
            <div class="panel panel-primary" id="pnlx">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <?php echo $Packages[1]->packagename ?></h3>
                </div>
                <div class="panel-body">
                    <div class="the-price">
                        <h1>
                            $<?php echo $Packages[1]->price ?></h1>
                    </div>
                    <table class="table">
                      <tbody>
                        <tr>
                          <td><b><?php echo $Packages[1]->packagedesc ?></b></td>
                        </tr>
                        <tr class="active">
                          <td><?php echo $Packages[1]->info1 ?>&nbsp;</td>
                        </tr>
                        <tr>
                         <td><?php echo $Packages[1]->info2 ?>&nbsp;</td>
                        </tr>
                        <tr class="active">
                         <td><?php echo $Packages[1]->info3 ?>&nbsp;</td>
                        </tr>
                        <tr>
                         <td><?php echo $Packages[1]->info4 ?>&nbsp;</td>
                        </tr>
                      </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <a role="button" style="width:100px" class="btn btn-primary" href="<?php echo $Packages[1]->link ?>"><?php echo $ButtonCaption ?></a>
                    </div>
            </div>
        </div>
        
        <div class="col-xs-3 col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <?php echo $Packages[2]->packagename ?></h3>
                </div>
                <div class="panel-body">
                    <div class="the-price">
                        <h1>
                            $<?php echo $Packages[2]->price ?></h1>
                    </div>
                    <table class="table">
                      <tbody>
                        <tr>
                          <td><b><?php echo $Packages[2]->packagedesc ?></b></td>
                        </tr>
                        <tr class="active">
                          <td><?php echo $Packages[2]->info1 ?>&nbsp;</td>
                        </tr>
                        <tr>
                          <td><?php echo $Packages[2]->info2 ?>&nbsp;</td>
                        </tr>
                        <tr class="active">
                         <td><?php echo $Packages[2]->info3 ?>&nbsp;</td>
                        </tr>
                        <tr>
                          <td><?php echo $Packages[2]->info4 ?>&nbsp;</td>
                        </tr>
                      </tbody>
                    </table>
                </div>
               <div class="panel-footer">
                    <a role="button" style="width:100px" class="btn btn-primary" href="<?php echo $Packages[2]->link ?>"><?php echo $ButtonCaption ?></a>
                    </div>
            </div>
        </div>
        
        <div class="col-xs-3 col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <?php echo $Packages[3]->packagename ?></h3>
                </div>
                <div class="panel-body">
                    <div class="the-price">
                        <h1>
                            $<?php echo $Packages[3]->price ?></h1>
                    </div>
                    <table class="table">
                      <tbody>
                        <tr>
                          <td><b><?php echo $Packages[3]->packagedesc ?></b></td>
                        </tr>
                        <tr class="active">
                          <td><?php echo $Packages[3]->info1 ?>&nbsp;</td>
                        </tr>
                        <tr>
                          <td><?php echo $Packages[3]->info2 ?>&nbsp;</td>
                        </tr>
                        <tr class="active">
                         <td><?php echo $Packages[3]->info3 ?>&nbsp;</td>
                        </tr>
                        <tr>
                          <td><?php echo $Packages[3]->info4 ?>&nbsp;</td>
                        </tr>
                      </tbody>
                    </table>
                </div>
               <div class="panel-footer">
                    <a role="button" style="width:100px" class="btn btn-primary" href="<?php echo $Packages[3]->link ?>"><?php echo $ButtonCaption ?></a>
                    </div>
            </div>
        </div>
  
  
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>