<div class="innercontent">
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">
  <h3 class="panel-title">Employees</h3>
</div>
<div class="panel-body">
<form role="form" class="form-horizontal" id="frmmain">
<div class="row">



  <div class="col-md-4">
    <div style="margin-bottom:8px;padding-top:0px;" class="well">
      <h4 style="text-align:center">Employees</h4>
        <div>

            <span <?php echo check_access("aemp")?> class="btn btn-default" id="btnAdd"><i class="fa fa-plus">&nbsp;</i>Add</span>
            <span <?php echo check_access("eemp")?> class="btn btn-default" id="btnModify"><i class="fa fa-pencil">&nbsp;</i>Modify</span>
            <span <?php echo check_access("demp")?> class="btn btn-default" id="btnDelete"><i class="fa fa-times">&nbsp;</i>Delete</span>
            


        
            
          <div class="clear"></div>
          </div>
      
       <div class="jqg">
      <table id="tbluser" class="">
      </table>
    </div>
    
    </div>
   
  </div>
  

  
   <div class="col-md-8">
    <div style="margin-bottom:8px;padding-top:0px;" class="well">
      <h4 style="text-align:center">Personal Data</h4>
       
       
       <span>Current user: </span><b><?php echo $user?></b>
       <br/>
       <span>Role: </span><b><?php echo $role?></b>
       <hr class="hrx" />
       
       
       <div class="col-md-12" style="<?php echo $onlyadmin ?>">
       
       <div class="form-group">
        <label class=" control-label col-md-3" style="width:auto;padding:8px 0px 0px 0px;">Business Name:</label>
        <div class="col-md-6">
       <input type="text" placeholder=""  value="<?php echo $business?>"  name="txtbusiness" id="txtbusiness" class="form-control required" />
       
        
       </div>
       <span class="btn btn-default" id="btnSavebusiness">Save</span>
       </div>
       <hr class="hrx clear" />
       </div>
       
       
       
       
       
       <b>ChangePassword</b>
       
       
       
       <div class="row">
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
                    <input type="password" placeholder="" class="form-control  required " name="txtpassn" id="txtpassn">
                  </div>
                </div>
                <div class="form-group">
                  <label class=" control-label">Re-type New Password</label>
                  <div class="">
                    <input type="password" placeholder="" class="form-control required " name="txtpassn2" id="txtpassn2">
                  </div>
                </div>
                
         
                
                
                
                <span class="btn btn-default" id="btnchangepass">Change Password</span>
                <span class="btn btn-default" id="btnclear">Clear</span>
              </div>
                     
            </div>
       
    </div>
    

   
  </div>
  

  
  
  

  
  
  
 
</div>





 </form>
</div>


<div id="frm_modal" class="modal "  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div  class="modal-dialog" style="width:700px;">
    <div class="modal-content">
      <div class="modal-header" style="padding:8px;">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 id="lblcaption" class="modal-title">Add New</h4>
      </div>
      <div class="modal-body" style="padding:6px;">
        <form name="frmForm" id="frmForm" class="form-horizontal" role="form">
          <div id="dvContainer" class="container">
            <div class="row">
              <div class="col-md-10">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Username</label>
                  <div class="col-sm-7" >
                    <input type="text" class="form-control required"  id="txtname" name="txtname" placeholder="" />
                  </div>
                </div>
                
                <div class="form-group">
                  <label  class="col-sm-3 control-label">Password</label>
                  <div class="col-sm-7">
                    <input id="txtpass" name="txtpass" type="password" class="form-control required "  placeholder="">
                  </div>
                </div>
                <div class="form-group">
                  <label  class="col-sm-3 control-label">Re-type Password</label>
                  <div class="col-sm-7">
                    <input id="txtpass2" name="txtpass2" type="password" class="form-control required "  placeholder="">
                  </div>
                </div>
                
         
                
                
                
                <input type="hidden" name="mode" id="mode" value="" />
                <input type="hidden" name="merchid" id="merchid" value="-1" />
              </div>
                     
            </div>
            <hr class="hrx" />
            User Access
            
            <div class="row">
            <div class="col-md-12">
            
                      <!-- Nav tabs -->
<ul class="nav nav-tabs" id="tabs">
  <li><a href="#tab1" data-toggle="tab">Merchandises</a></li>
  <li><a href="#tab2" data-toggle="tab">Recipes</a></li>
  <li><a href="#tab3" data-toggle="tab">Market List</a></li>
  <li><a href="#tab4" data-toggle="tab">Reports</a></li>
  <li><a href="#tab5" data-toggle="tab">Control</a></li>
  <li><a href="#tab6" data-toggle="tab">Employees</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  
  <div class="tab-pane active" id="tab1">
  
  
  <div class="checkbox">
    <label>
      <input id="am" name="am" type="checkbox"> Add Merchandise
    </label>
  </div>
  <div class="checkbox">
    <label>
      <input id="em" name="em" type="checkbox"> Modify Merchandise
    </label>
  </div>
  <div class="checkbox">
    <label>
      <input id="dm" name="dm" type="checkbox"> Delete Merchandise
    </label>
  </div>
  <div class="checkbox">
    <label>
      <input id="xm" name="xm" type="checkbox"> Export Merchandise
    </label>
  </div>
  <div class="checkbox">
    <label>
      <input id="im" name="im" type="checkbox"> Import Merchandise
    </label>
  </div>
  <div class="clear">
  </div>
  
  
  </div>
  
  <div class="tab-pane" id="tab2">
    <div class="checkbox">
    <label>
      <input id="ar" name="ar" type="checkbox"> Add Recipe
    </label>
  </div>
  <div class="checkbox">
    <label>
      <input id="mr" name="mr" type="checkbox"> Modify Recipe
    </label>
  </div>
  <div class="checkbox">
    <label>
      <input id="dr" name="dr" type="checkbox"> Delete Recipe
    </label>
  </div>
  <div class="checkbox">
    <label>
      <input id="pr" name="pr" type="checkbox"> Print Recipe
    </label>
  </div>
  <div class="clear">
  </div>
  </div>
    <div class="tab-pane" id="tab3">
    
    
     <div class="checkbox">
    <label>
      <input id="al" name="al" type="checkbox"> Add Market List
    </label>
  </div>

  <div class="checkbox">
    <label>
      <input id="rl" name="rl" type="checkbox"> Delete Market List
    </label>
  </div>
  
  <div class="checkbox">
    <label>
      <input id="pl" name="pl" type="checkbox"> Print Market List
    </label>
  </div>
  
  <div class="clear">
    </div>
  </div>
    <div class="tab-pane" id="tab4">
    
         <div class="checkbox">
    <label>
      <input id="vp" name="vp" type="checkbox"> View Reports
    </label>
  </div>

  <div class="checkbox">
    <label>
      <input id="vmp" name="vmp" type="checkbox"> Merchandise Report
    </label>
  </div>
  
  <div class="checkbox">
    <label>
      <input id="vrp" name="vrp" type="checkbox"> Recipes Report
    </label>
  </div>
  
  <div class="checkbox">
    <label>
      <input id="vlp" name="vlp" type="checkbox"> Market List Report
    </label>
  </div>
  
  <div class="clear">
    </div>
    
  </div>
    <div class="tab-pane" id="tab5">
    
    
             <div class="checkbox">
    <label>
      <input id="vc" name="vc" type="checkbox"> View Control Page
    </label>
  </div>

<div class="clear" style="padding-top:10px;">
  <div >
    <label>
       Merchandise Report :&nbsp;&nbsp;
       <label><input id="mta" name="mta"  type="checkbox"> Add</label>
       <label><input id="mte" name="mte" type="checkbox"> Edit</label>
       <label><input id="mtd" name="mtd" type="checkbox"> Delete</label>
    </label>
  </div>
  </div>
  
  <div class="clear" style="padding-top:2px;">
  <div >
    <label>
       Recipe Categories :&nbsp;&nbsp;
       <label><input id="rca" name="rca" type="checkbox"> Add</label>
       <label><input id="rce" name="rce" type="checkbox"> Edit</label>
       <label><input id="rcd" name="rcd" type="checkbox"> Delete</label>
    </label>
  </div>
  </div>
  
   <div class="clear" style="padding-top:2px;">
  <div >
    <label>
       Unit Of Purchase :&nbsp;&nbsp;
       <label><input id="uma" name="uma" type="checkbox"> Add</label>
       <label><input id="ume" name="ume" type="checkbox"> Edit</label>
       <label><input id="umd" name="umd"  type="checkbox"> Delete</label>
    </label>
  </div>
  </div> 
  
  
   <div class="clear" style="padding-top:2px;">
  <div >
    <label>
       Outlets :&nbsp;&nbsp;
       <label><input id="ola" name="ola"  type="checkbox"> Add</label>
       <label><input id="ole" name="ole"  type="checkbox"> Edit</label>
       <label><input id="old" name="old" type="checkbox"> Delete</label>
    </label>
  </div>
  </div>
  
     <div class="clear" style="padding-top:2px;">
  <div >
    <label>
       Divisions :&nbsp;&nbsp;
       <label><input id="dva" name="dva" type="checkbox"> Add</label>
       <label><input id="dve" name="dve" type="checkbox"> Edit</label>
       <label><input id="dvd" name="dvd" type="checkbox"> Delete</label>
    </label>
  </div>
  </div>  
  
  <div class="clear" style="padding-top:2px;">
  <div >
    <label>
       Unit of measure :&nbsp;&nbsp;
       <label><input id="umma" name="umma" type="checkbox"> Add</label>
       <label><input id="umme" name="umme" type="checkbox"> Edit</label>
       <label><input id="ummd" name="ummd" type="checkbox"> Delete</label>
    </label>
  </div>
  </div>  
  
  <div class="clear">
    </div>
    
  </div>
    <div class="tab-pane" id="tab6">
    
    
     <div class="checkbox">
    <label>
      <input id="vemp" name="vemp" type="checkbox"> View Employee List   
    </label>
  </div>

  <div class="checkbox">
    <label>
      <input id="aemp" name="aemp" type="checkbox"> Add Employee   
    </label>
  </div>
  
  <div class="checkbox">
    <label>
      <input id="eemp" name="eemp" type="checkbox"> Edit Employee
    </label>
  </div>
  
  <div class="checkbox">
    <label>
      <input id="demp" name="demp" type="checkbox"> Delete Employee  
    </label>
  </div>
  
  <div class="clear">
    </div>
    
    
  </div>
            
            
            </div>
            </div>
            
          </div>
          </div>
        </form>
      </div>
      <div class="modal-footer"> <span id="btnCancel" type="button" class="btn btn-default" data-dismiss="modal" style="width:90px;">Cancel</span> <span id="btnOk" type="button" class="btn btn-primary"  style="width:90px;">Ok</span> </div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
<!-- /.modal --> 

</div>
</div>
</div>
</div>

