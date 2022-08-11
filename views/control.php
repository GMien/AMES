<div class="innercontent">
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">
  <h3 class="panel-title">Base Data</h3>
</div>


<div class="panel-body">
<form role="form" class="form-inline" id="frmmain">
<div class="row">



  <div class="col-md-4">
    <div style="margin-bottom:8px;padding-top:0px;" class="well">
      <h4 style="text-align:center">Merchandise Types</h4>
        <div>
        <div class="form-group col-sm-9" style="margin:0 4px 4px 0;padding:4px 0 0 0;">
        <div>
          <input <?php echo check_access("mta")?>  type="text" id="txtMerchType" name="txtMerchType" class="form-control required">
          </div>
          
          </div>
          <span <?php echo check_access("mta")?> style="width:68px;" class="btn btn-primary btn-xs" id="btnAddMerchType" data-data=""><i class="fa fa-plus">&nbsp;</i>Add</span>
          <span <?php echo check_access("mtd")?>  style="width:68px;"  class="btn btn-danger btn-xs" id="btnRemMerchType" data-data=""><i class="fa fa-minus">&nbsp;</i>Remove</span> 
          <div class="clear"></div>
          </div>
      
       <div class="jqg">
      <table id="tblmerchandise" class="">
      </table>
    </div>
    
    </div>
   
  </div>
  
  

  
   <div class="col-md-4">
    <div style="margin-bottom:8px;padding-top:0px;" class="well">
      <h4 style="text-align:center">Recipe Categories</h4>
        <div>
        <div class="form-group col-sm-9" style="margin:0 4px 4px 0;padding:4px 0 0 0;">
        <div>
          <input  <?php echo check_access("rca")?> type="text" id="txtcat" name="txtcat" class="form-control required">
          </div>
          
          </div>
          <span <?php echo check_access("rca")?> style="width:68px;" class="btn btn-primary btn-xs" id="btnAddcat" data-data=""><i class="fa fa-plus">&nbsp;</i>Add</span>
          <span <?php echo check_access("rcd")?> style="width:68px;"  class="btn btn-danger btn-xs" id="btnRemcat" data-data=""><i class="fa fa-minus">&nbsp;</i>Remove</span> 
          <div class="clear"></div>
          </div>
      
       <div class="jqg">
      <table id="tblcats" class="">
      </table>
    </div>
    
    </div>
   
  </div>
  


  
  <div class="col-md-4">
    <div style="margin-bottom:8px;padding-top:0px;" class="well">
      <h4 style="text-align:center">Units of Purchase</h4>
        <div>
        <div class="form-group col-sm-9" style="margin:0 4px 4px 0;padding:4px 0 0 0;">
        <div>
          <input <?php echo check_access("uma")?> type="text" id="txtmeasure" name="txtmeasure" class="form-control required">
          </div>
          
          </div>
          <span <?php echo check_access("uma")?> style="width:68px;" class="btn btn-primary btn-xs" id="btnAddmea" data-data=""><i class="fa fa-plus">&nbsp;</i>Add</span>
          <span <?php echo check_access("umd")?> style="width:68px;"  class="btn btn-danger btn-xs" id="btnRemea" data-data=""><i class="fa fa-minus">&nbsp;</i>Remove</span> 
          <div class="clear"></div>
          </div>
      
       <div class="jqg">
      <table id="tblmea" class="">
      </table>
    </div>
    
    </div>
   
  </div>
  
  
  
  
  
  
  

  
  
  
 
</div>



<div class="row">



  <div class="col-md-4">
    <div style="margin-bottom:8px;padding-top:0px;" class="well">
      <h4 style="text-align:center">Outlets</h4>
        <div>
        <div class="form-group col-sm-9" style="margin:0 4px 4px 0;padding:4px 0 0 0;">
        <div>
          <input <?php echo check_access("ola")?> type="text" id="txtout" name="txtout" class="form-control required">
          </div>
          
          </div>
          <span <?php echo check_access("ola")?> style="width:68px;" class="btn btn-primary btn-xs" id="btnAddout" data-data=""><i class="fa fa-plus">&nbsp;</i>Add</span>
          <span <?php echo check_access("old")?> style="width:68px;"  class="btn btn-danger btn-xs" id="btnRemout" data-data=""><i class="fa fa-minus">&nbsp;</i>Remove</span> 
          <div class="clear"></div>
          </div>
      
       <div class="jqg">
      <table id="tblout" class="">
      </table>
    </div>
    
    </div>
   
  </div>
  
  
  
  
   <div class="col-md-4">
    <div style="margin-bottom:8px;padding-top:0px;" class="well">
      <h4 style="text-align:center">Divisions</h4>
        <div>
        <div class="form-group col-sm-9" style="margin:0 4px 4px 0;padding:4px 0 0 0;">
        <div>
          <input <?php echo check_access("dva")?> type="text" id="txtdiv" name="txtdiv" class="form-control required">
          </div>
          
          </div>
          <span <?php echo check_access("dva")?>  style="width:68px;" class="btn btn-primary btn-xs" id="btnAdddiv" data-data=""><i class="fa fa-plus">&nbsp;</i>Add</span>
          <span <?php echo check_access("dvd")?> style="width:68px;"  class="btn btn-danger btn-xs" id="btnRemdiv" data-data=""><i class="fa fa-minus">&nbsp;</i>Remove</span> 
          <div class="clear"></div>
          </div>
      
       <div class="jqg">
      <table id="tbldiv" class="">
      </table>
    </div>
    
    </div>
   
  </div>
  

  
  <div class="col-md-4">
    <div style="margin-bottom:8px;padding-top:0px;" class="well">
      <h4 style="text-align:center">Unit Of Measure</h4>
        <div>
        <div class="form-group col-sm-9" style="margin:0 4px 4px 0;padding:4px 0 0 0;">
        <div>
          <input <?php echo check_access("umma")?> type="text" id="txtumm" name="txtumm" class="form-control required">
          </div>
          
          </div>
          <span <?php echo check_access("umma")?>  style="width:68px;" class="btn btn-primary btn-xs" id="btnAddumm" data-data=""><i class="fa fa-plus">&nbsp;</i>Add</span>
          <span <?php echo check_access("ummd")?> style="width:68px;"  class="btn btn-danger btn-xs" id="btnRemumm" data-data=""><i class="fa fa-minus">&nbsp;</i>Remove</span> 
          <div class="clear"></div>
          </div>
      
       <div class="jqg">
      <table id="tblumm" class="">
      </table>
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

