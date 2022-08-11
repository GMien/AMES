
<div id="topheader">
    <div id="logo"> 		<a href="/">
			<img src="http://www.arskills.com/wp-content/themes/arskills/img/access-logo.png" alt="" border="0" width="175" />		</a>
    </div>
  </div>


<div id="menu">
		<ul class="menu">
			<li><a href="<?php echo site_url("") ?>" class="parent <?php echo is_active("") ?>"><span>Home</span></a></li>
            <li  class="<?php echo is_active("merchandise") ?>"><a href="<?php echo site_url("merchandise") ?>"><span>Merchandise</span></a></li>
            
            <li class="<?php echo is_active("recipes") ?>"><a href="<?php echo site_url("recipes") ?>"><span>Recipes</span></a></li>
            <li class="<?php echo is_active("marketlist") ?>"><a href="<?php echo site_url("marketlist") ?>"><span>Market List</span></a></li>
            
     <?php if(has_access("vp") && ( has_access("vmp") || has_access("vrp") || has_access("vlp")) )
	 { echo('
            <li class="'.is_active("reports").'"><a href="'.site_url("reports").'"><span>Reports</span></a></li>');
	 }
	 ?>
            
   <?php if(has_access("vc") )
   {
       echo('<li class="'.is_active("control") .'"><a href="'.site_url("control").'"><span>Control</span></a></li>');
   }?>
            <li class="<?php echo is_active("employees") ?>"><a href="<?php echo site_url("employees") ?>"><span>Employees</span></a></li>
            <!--li class="<?php echo is_active("pricing") ?>"><a href="<?php echo site_url("pricing") ?>"><span>Pricing</span></a></li-->
            <li class="<?php echo is_active("login") ?>"><a href="<?php echo site_url("login?act=logout") ?>"><span>Log out</span></a></li>

		</ul>
        
        <a style="display:block;pointer-events: none;
   cursor: default;"><span><i class="fa fa-dot-circle-o" >&nbsp;</i><b><?php echo $this->session->userdata('userbusiness') ?></b></span></a>
        
        <ul style="float:right">
        <li><a style="display:block;pointer-events: none;
   cursor: default;"><span><i class="fa fa-user" >&nbsp;</i><?php echo $this->session->userdata('username') ?></span></a></li>
        </ul>
	</div>
