<div class="container maincontent">
  	
	<div class="row">
        <div id="dvform" class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <form id="frm_register" class="well" style="background:#fff;" method="post">
                <div class="">
                    <h3>Register a new account</h3>
                    <p>Already Signed Up? Click <a href="<?php echo site_url('login')?>" class="color-green">Sign In</a> to login your account.</p>                    
                </div>

               <div>
                <label class="control-label">Username<span class="color-red">*</span></label>
                <input id="txtusername" name="txtusername" type="text" class="form-control required" style="margin-bottom:8px;">
               </div>
               
               <div>
                <label  class="control-label">Your Business Name<span class="color-red">*</span></label>
                <input id="txtbusiness" name="txtbusiness" type="text" class="form-control required" style="margin-bottom:8px;">
               </div>
               
               <div>
                <label  class="control-label">Email Address <span class="color-red">*</span></label>
                <input id="txtemail" name="txtemail" type="text" class="form-control required email" style="margin-bottom:8px;">
               </div>
               
                <div class="row">
                    <div class="col-sm-6">
                        <label  class="control-label">Password <span class="color-red">*</span></label>
                        <input id="txtpass" name="txtpass" type="password" class="form-control required" style="margin-bottom:8px;">
                    </div>
                    <div class="col-sm-6">
                        <label  class="control-label">Confirm Password <span class="color-red">*</span></label>
                        <input id="txtpass2" name="txtpass2" type="password" class="form-control required" style="margin-bottom:8px;">
                    </div>
                </div>

                <hr>
                <div class="row">
                
                
                    <div class="col-sm-8">
                    <label class="col-sm-3 control-label" style="margin-top:6px;">Package</label>
                          <div class="col-sm-8">                          
                            <select style="width:120px;" class="col-sm-5 form-control input-sm required" name="cbpackage" id="cbpackage">
                              <option value=""></option>
                            </select>
                          </div>
                          
                       <input type="hidden" id="item_number" name="item_number" value="-1"/>
                    </div>
              </div>
                    <div class="row">
                    <div class="col-sm-12">

                    <span class="control-label" style="margin-top:6px;float:left;padding-left:15px;">Description:</span>
                    <label id="lbldesc" class="col-sm-8 control-label" style="margin-top:6px;">---</label>
                    </div>
                    </div>
                    <div class="row">
                     <div class="col-sm-8">
                    <span class="control-label" style="margin-top:6px;float:left;padding-left:15px;">Price:</span>
                    <label id="lblprice" class="col-sm-8 control-label" style="margin-top:6px;">---</label>
                    </div>
                    </div>
                    
                   
 <hr>
                <div class="row">
                    <div class="col-lg-6">
                                              
                    </div>
                    <div class="col-lg-6 text-right">
                        <span class="btn btn-default" id="btnSubmit">Register & Pay</span>                        
                    </div>
                </div>
            </form>
        </div>
    </div><!--/row-->

</div>
<!--/container-->