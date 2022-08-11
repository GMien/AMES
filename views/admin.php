<div style="margin:4px">
<div class="row">
<div class="col-md-12">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title" style="text-align:left;">Admin</h3>
    </div>
    <div class="panel-body" style="padding-top:16px;">
      <div class="container">
        <div class="row">
          <div class="row">
            <div class="col-md-12"> 
              
              <!-- Nav tabs -->
              <ul class="nav nav-tabs" id="tabs">
                <li><a href="#tab1" data-toggle="tab">Settings</a></li>
                <li><a href="#tab2" data-toggle="tab">Pricing</a></li>
                <li><a href="#tab3" data-toggle="tab">User List</a></li>
                <li><a href="#tab4" data-toggle="tab">Payment List</a></li>
              </ul>
              
              <!-- Tab panes -->
              <div class="tab-content">
                <div class="tab-pane active" id="tab1">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-12">
                        <form id="frmsettings" class="form-horizontal" role="form">
                          <hr class="hrx" />
                          <h4>Settings</h4>
                          <div class="form-group">
                            <label  class="col-sm-2 control-label">Paypal Email</label>
                            <div class="col-sm-3">
                              <input type="text" id="txtPaypal" name="txtPaypal" class="form-control required email" value="<?php echo $txtPaypal ?>"/>
                            </div>
                          </div>
                          <div class="form-group">
                            <label  class="col-sm-2 control-label">Admin Email</label>
                            <div class="col-sm-3">
                              <input type="text" id="txtadmin" name="txtadmin"  class="form-control required email" value="<?php echo $txtadmin ?>" />
                            </div>
                          </div>
                          <div class="form-group">
                            <label  class="col-sm-2 control-label">Support Email</label>
                            <div class="col-sm-3">
                              <input type="text" id="txtsupport" name="txtsupport" class="form-control required email" value="<?php echo $txtsupport ?>"/>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-2"> <span id="btnsavesetting" class="btn btn-default" style="float:right">Save Data</span> </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <form id="frmpasswords" class="form-horizontal" role="form">
                          <hr class="hrx" />
                          <h4>Change Password</h4>
                          <div class="col-md-4" style="margin-left:14px;">
                            <div class="form-group">
                              <label class="control-label">Current Password</label>
                              <div class="">
                                <input type="password" placeholder="" data-data="<?php echo $currentpass?>" name="txtpasso" id="txtpasso" class="form-control required currentpass" />
                              </div>
                            </div>
                            <div class="form-group">
                              <label class=" control-label">New Password</label>
                              <div class="">
                                <input type="password" placeholder="" class="form-control col-md-2 required " name="txtpassn" id="txtpassn">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class=" control-label">Re-type New Password</label>
                              <div class="">
                                <input type="password" placeholder="" class="form-control col-md-2 required " name="txtpassn2" id="txtpassn2">
                              </div>
                            </div>
                            <span class="btn btn-default" id="btnchangepass">Change Password</span> <span class="btn btn-default" id="btnclear">Clear</span> </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane active" id="tab2">
                  <div class="container">
                    <div class="row jqg">
                    
                    <table id="tbl_pricing">
                    </table>
                    </div>
                  </div>
                </div>
                <div class="tab-pane active" id="tab3"> 
                <div class="container">
                
                <span id="btnAdd" class="btn btn-default"><i class="fa fa-plus">&nbsp;</i>Register New User</span>
                <span id="btnEdt" class="btn btn-default hide"><i class="fa fa-edit">&nbsp;</i>Edit User</span>
                    <div class="row jqg">
                    
                    <table id="tbluser">
                    </table>
                    </div>
                  </div>
                 </div>
                <div class="tab-pane active" id="tab4"> <div class="container">
                    <div class="row jqg">
                    
                    <table id="tblpay">
                    </table>
                    </div>
                  </div> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
