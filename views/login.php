<div class="container maincontent">
  	
	<div class="row">
        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
            <form id="frmmain" class="well" style="background:#fff;" method="post">
                <div style="text-align:center">            
                    <h4>Login to your account</h4>
                </div>

                <div class="input-group" style="margin-bottom:20px;margin-top:20px;">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <div>
                    <input type="text" id="txtuser" value="<?php echo $txtuser ?>" name="txtuser" class="form-control required" placeholder="Username">
                    </div>
                </div>                    
                <div class="input-group" style="margin-bottom:20px;">
                    <span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>
                    <div>
                    <input type="password" id="txtpass" name="txtpass" class="form-control required" placeholder="Password">
                    </div>
                </div>                    

                <div class="row">
                
                
                <div class="alert alert-danger <?php echo $hide ?>">
        <?php echo $message ?>
      </div>
                    <div class="col-md-6">
                           <label class="danger"></label>  
                                          
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn pull-right btn-default">Login</button>                        
                    </div>
                </div>
<!--
                <hr>

                <h4>Forget your Password ?</h4>
                <p>no worries, <a href="#" class="color-green">click here</a> to reset your password.</p>-->
            </form>            
        </div>
    </div><!--/row-->

</div>
<!--/container-->