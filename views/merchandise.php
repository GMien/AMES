
<div class="innercontent">


  <div class="row">

    <div class="col-md-12">
    
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Merchandise</h3>
        </div>
        
        <div class="panel-body">
        
          <div class="row">
            <div class="col-md-4">
            <div class="well" style="margin-bottom:8px;padding:8px;">
              <form class="form-inline" role="form">
                <label for="cbTypes" class="control-label">Type:</label>
                <div class="form-group ">
                  <select id="cbTypes" class="form-control input-sm" style="width:180px">
                    <option value="-1">All</option>
                  </select>
                  
                   <span id="btnFilter" class="btn btn-primary st" title="Filter"><i class="fa fa-filter" ></i></span>
                  </div>
              </form>
              </div>
            </div>
            
            
            <div class="col-md-8">
            <div class="well" style="margin-bottom:8px;">
            <span <?php echo check_access("am")?>  id="btnAdd" class="btn btn-default"><i class="fa fa-plus">&nbsp;</i>Add</span>
            <span id="btnModify" <?php echo check_access("em")?> class="btn btn-default"><i class="fa fa-pencil">&nbsp;</i>Modify</span>
            <span id="btnDelete" <?php echo check_access("dm")?>  class="btn btn-default"><i class="fa fa-times">&nbsp;</i>Delete</span>
            
            <span id="btnExport" <?php echo check_access("xm")?>  class="btn btn-success" style="margin-left:42px;"><i class="fa fa-save">&nbsp;&nbsp;</i>Export</span>
            
            <span id="btnImport" <?php echo check_access("im")?>  class="btn btn-success" style="margin-left:4px;"><i class="fa fa-save">&nbsp;&nbsp;</i>Import</span>
            </div>
            </div>
            
            
          </div>
          <hr style="margin-top:0px;margin-bottom:4px" />
          <div class="row">
          <div class="col-md-12">
          <div class="jqg" id="jqg">
            <table id="tblGrid" class="">
            </table>
            <div id="tblGridPager"/>
          </div>
          </div>
          </div>
          
        </div><!--panel boddy-->
        
      </div>
      
      
    </div>
    

    
  </div>
  
  
  <div id="frm_modal" class="modal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div  class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 id="lblcaption" class="modal-title">Add New</h4>
      </div>
      <div class="modal-body">
        
       <form name="frmForm" id="frmForm" class="form-horizontal" role="form">
  <div class="form-group">
    <label class="col-sm-5 control-label">Merchandise Name</label>
    <div class="col-sm-7">
      <input type="text" class="form-control required" id="mname" name="mname" placeholder="">
    </div>
  </div>
  
   <div class="form-group">
    <label  class="col-sm-5 control-label">Type</label>
    <div class="col-sm-7">
<select id="typeid" name="typeid" class="form-control input-sm required" style="width:180px">
                    <option value=""></option>
                  </select>
    </div>
  </div>
  
 <div class="form-group">
    <label  class="col-sm-5 control-label">Unit of Purchase</label>
    <div class="col-sm-7">
<select id="uom" name="uom" class="required form-control input-sm" style="width:180px">
                    <option value=""></option>
                  </select>
    </div>
  </div> 
  
  <div class="form-group">
    <label for="txtuniteq" class="col-sm-5 control-label">Unit of Purchase Cost</label>
    <div class="col-sm-7">
      <input id-"ucost" name="ucost" type="text" class="form-control  required number" id="txtuniteq" placeholder="">
    </div>
  </div>
  
    <div class="form-group">
    <label  class="col-sm-5 control-label">Unit Equivalent</label>
    <div class="col-sm-7">
      <input id-"uq" name="uq" type="text" class="form-control required number" id="txtuniteq" placeholder="">
    </div>
  </div> 
  

 <div class="form-group">
   <label  class="col-sm-5 control-label">Unit of Measure</label>
    <div class="col-sm-7">
<select id="cuom" name="cuom" class="required form-control input-sm" style="width:180px">
                     <option value=""></option>
                  </select>
    </div>
  </div>   
  
  <div class="form-group">
    <label for="txtuniteq" class="col-sm-5 control-label">Cooking Loss</label>
    <div class="col-sm-7">
      <input id-"loss" name="loss" type="text" class="form-control  required number" id="txtuniteq" placeholder="">
    </div>
  </div>
  <input type="hidden" name="mode" id="mode" value="" />
  <input type="hidden" name="merchid" id="merchid" value="-1" />
  </form> 
  
      </div>
      <div class="modal-footer">
        <span id="btnCancel" type="button" class="btn btn-default" data-dismiss="modal" style="width:90px;">Cancel</span>
        <span id="btnOk" type="button" class="btn btn-primary"  style="width:90px;">Add</span>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

  
</div>


