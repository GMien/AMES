<div class="innercontent">
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Recipes</h3>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-4">
            <div class="well jqg" style="margin-bottom:8px;padding:8px;">
              <form class="form-inline" role="form">
                <label for="cbTypes" class="control-label">Type:</label>
                <div class="form-group">
                
                
                  <select id="cbTypes" class="form-control input-sm" style="width:180px">
                    <option value="-1">All</option>
                  </select>
                  
                  
                   </div>
                   <span id="btnFilter" class="btn btn-primary st" title="Filter"><i class="fa fa-filter" ></i></span>
              </form>
              <hr style="margin:4px 0 4px 0;border-top:groove 2px #eee" />
              <table id="tblGrid">
              </table>
              <div id="tblGridPager"></div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="well" style="margin-bottom:8px;">
             <span id="btnAdd" <?php echo check_access("ar")?> class="btn btn-default"><i class="fa fa-plus">&nbsp;</i>Add</span>
             
              <span id="btnModify" <?php echo check_access("mr")?> class="btn btn-default"><i class="fa fa-pencil">&nbsp;</i>Modify</span> 
              
              <span id="btnDelete" <?php echo check_access("dr")?> class="btn btn-default"><i class="fa fa-times">&nbsp;</i>Delete</span> 
              
              <span id="btnDetails" class="btn btn-default"><i class="fa fa-tasks">&nbsp;</i>Details...</span>
              
               <span id="btnPrint" <?php echo check_access("pr")?> class="btn btn-primary" style="margin-left:42px;width:90px;"><i class="fa fa-save">&nbsp;&nbsp;</i>Print</span>
               
                </div>
                
                
            <div class="well details" style="margin-bottom:8px;">
              <div class="row" id="rowtitle" style="clear:both;">
                <div class="col-md-12" style="">
                <div class="col-md-8" style="fload:left;">
                  <div class="rw">
                    <label><b>Recipe :</b></label>
                    <b id="lblRecipeName"></b></div>
                  <div class="rw">
                    <label>Category :</label>
                    <span id="lblCategory"></span></div>
                  <div class="rw">
                    <label>Standard Yield :</label>
                    <span id="lblStandardYiel"></span></div>
                  <div class="rw" style="">
                    <label>Serving Size :</label>
                    <span id="lblServingSize"></span></div>
                    </div>
                    <img style="clear:right;display:block;float:right;;width:139px;height:92px;" id="imgrecipes" class="thumbnail" src="img/ni.png"  alt="" > </div>
                    <div class="clear"  style="clear:both;"></div>
                </div>
                
              <hr class="hrx"/>
              <div id="dvprocd"><b>Cooking Procedure</b></div>
              <div id="dvprocedure" style="overflow-x: hidden;overflow-y:auto;height:500px;border-radius:5px;border:1px solid #ccc;padding:6px;margin-top:4px;">
                <p id="lblCooking" style="margin-top:6px;font-size:small"> </p>
              </div>
            </div>
          </div>
        </div>
        <hr style="margin-top:0px;margin-bottom:4px" />
      </div>
      <!--panel boddy--> 
      
    </div>
  </div>
</div>
<div id="frm_modal" class="modal "  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div  class="modal-dialog" style="width:800px;">
    <div class="modal-content">
      <div class="modal-header" style="padding:8px;">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 id="lblcaption" class="modal-title">Add New</h4>
      </div>
      <div class="modal-body" style="padding:6px;">
        <form name="frmForm" id="frmForm" class="form-horizontal" role="form">
          <div id="dvContainer" class="container">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="col-sm-5 control-label">Recipe Name</label>
                  <div class="col-sm-7" >
                    <input type="text" class="form-control required"  id="txtname" name="txtname" placeholder="" />
                  </div>
                </div>
                <div class="form-group">
                  <label  class="col-sm-5 control-label">Category</label>
                  <div class="col-sm-7">
                    <select id="typeid" name="typeid" class="form-control input-sm required" style="">
                      <option value=""></option>
                    </select>
                  </div>
                </div>
                
                
                
                <div class="form-group">
                  <label  class="col-sm-5 control-label">Standard Yield</label>
                  <div class="col-sm-3">
                    <input id="syield" name="syield" type="text" class="form-control required number"  placeholder="">
                   
                  </div> <label id="lblstupid" class="control-label">Grams Per Serving</label>
                </div>
                
                
                <div class="form-group">
                  <label  class="col-sm-5 control-label">Serving Size</label>
                  <div class="col-sm-3">
                  <div>
                    <input id="ssize" name="ssize" type="text" class="form-control required number"  placeholder="">
                    </div>
                  </div>
                  
                  

                  
                  <div class="col-sm-3" style="padding:0;margin-left:0;">
                  <div>
                    <select id="cbsunit" name="cbsunit" class="form-control input-sm required" style="">
                    <option value=""></option>
                      <option value="grams">grams</option>
                      <option value="piece/s">piece/s</option>
                      <option value="slice/s">slice/s</option>

                    </select>
                    </div>
                  </div>
                  
                </div>
                
                
                
                
                
          <div class="form-group" style="">
                  <label  class="col-sm-5 control-label">Price per Serving</label>
                  <div class="col-sm-7">
                    <input id="txtprice" name="txtprice" type="text" class="form-control required number"  placeholder="">
                  </div>
                </div>      
                
                
                
                
                
                
                
                 <label  class="control-label">Recipe Ingrediants</label>
                <div class="form-group">
                  <div class="col-sm-7">
                    <select id="cbmerch" name="cbmerch" class=" form-control input-sm" style="">
                      <option value=""></option>
                    </select>
                  </div>
                  <span id="btnaddmerch" class="btn btn-success btn-xs" style="margin:4px 4px 0 0;">Add To List</span> <span id="btnremovemerch" class="btn btn-danger btn-xs" style="margin:4px 4px 0 0;">Remove</span> </div>
                <div class="jqg">
                  <table id="grid_form">
                  </table>
                </div>
                
                <input type="hidden" name="mode" id="mode" value="" />
                <input type="hidden" name="merchid" id="merchid" value="-1" />
              </div>
              <div class="col-md-6">
                <div> <img alt="" data-filename="" src="img/nis.png" class="thumbnail" id="imgload" style="float:right;width:84px;height:60px;">
                  <div style="float:right;margin-right:6px;padding:4px 0 4px 0;"> <span id="btnload" class="btn btn-success btn-xs clear block" style="margin-bottom:5px;">Load image...</span> <span id="btnclearimage" class="btn btn-danger btn-xs clear block">Remove Image</span> </div>
                </div>
                <div class="clear"></div>
                
                
                
                <div>
                  <label  class="control-label">Preparation Time</label>
                  <div class="">
                    <input id="preptime" name="preptime" type="text" class="form-control "  placeholder="">
                  </div>
                </div>
                
                
                <div>
                  <label  class="control-label">Serving Instruction</label>
                  <textarea id="txtinst" name="txtinst" class="form-control" rows="2" style="font-size:11px;"></textarea>
                </div>
                <div>
                  <label  class="control-label">Cooking Procedure</label>
                  <textarea id="txtproc" name="txtproc" class="form-control" rows="10" style="font-size:11px;"></textarea>
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

<!--Details Modal-->
<div id="frm_modal_details" class="modal "  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div  class="modal-dialog" style="width:980px;">
    <div class="modal-content">
      <div class="modal-header" style="padding:4px;">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <b id="lblcaptionD" class="modal-title">RecipeName</b>
      </div>
      <div class="modal-body" style="padding:6px;">
        <div class="row">
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-5">
                <div class="rw">
                  <label>Category :</label>
                  <span id="lblcategoryD">Seafoods</span></div>
                <div class="rw">
                  <label>Standard Yield :</label>
                  <span id="lblsyieldD">200</span></div>
                <div class="rw">
                  <label>Serving Size :</label>
                  <span id="lblServingSizeD">20</span></div>
              </div>
              <div class="col-md-7">
                <div class="rw">
                  <label>Preparation Time :</label>
                  <span id="lblPrepTimeD">Seafoods</span></div>
                <div class="rw">
                  <label>Serving Instruction :</label>
                  <span id="lblInstD">200</span></div>
              </div>
            </div>
          </div>
          <div class="col-md-3" style="margin-left:0px;padding-left:0px;padding-right:0px;">
            <div class="form-group">
              <label class="col-sm-7 control-label" style="margin-top:7px;padding:0 1px 0 0;text-align:right;">Adjusted Yield</label>
              <div class="col-sm-4" style="padding-left:0px;margin-bottom:6px;">
                <input type="text"  placeholder="" name="txtalloc1" id="txtalloc1" class="form-control input-sm number">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-7 control-label" style="margin-top:7px;padding:0 1px 0 0;text-align:right;">Conversion Factor</label>
              <div class="col-sm-4" style="padding-left:0px;margin-bottom:6px;">
                <input type="text" style="cursor:text" disabled="disabled" placeholder="" name="txtfactor1" id="txtfactor1" class="form-control input-sm required">
              </div>
            </div>
          </div>
          <div class="col-md-3" style="margin-left:0px;padding-left:0px;padding-right:0px;">
            <div class="form-group">
              <label class="col-sm-7 control-label" style="margin-top:7px;padding:0 1px 0 0;text-align:right;">Adjusted Serving Size</label>
              <div class="col-sm-4" style="padding-left:0px;margin-bottom:6px;">
                <input type="text"  placeholder="" name="txtalloc2" id="txtalloc2" class="form-control input-sm number">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-7 control-label" style="margin-top:7px;padding:0 1px 0 0;text-align:right;">Conversion Factor</label>
              <div class="col-sm-4" style="padding-left:0px;margin-bottom:6px;">
                <input type="text" style="cursor:text" disabled="disabled" placeholder="" name="txtfactor2" id="txtfactor2" class="form-control input-sm required">
              </div>
            </div>
          </div>
        </div>
        <hr style="margin-top:0px;margin-bottom:4px">
        <div  class="row">
          
          <div id="dvgrid">
          <div class="col-md-12 jqg">
            <table id="grid_details">
            </table>
          </div>
          <div id="handle" class="ui-resizable-handle ui-resizable-s" style="left:45%;background-image:url(img/spl.png);width:96px;height:8px;display:none;"></div>
          </div>
        </div>
        <div class="row" style="margin-top:6px;">
          <div class="col-md-6"> </div>
          <div class="col-md-3" style="margin-left:0px;padding-left:0px;padding-right:0px;">
            <div class="form-group">
              <label style="margin-top:7px;padding:0 1px 0 0;text-align:right;" class="col-sm-7 control-label">Actual Price:</label>
              <div style="padding-left:0px;margin-bottom:6px;" class="col-sm-4">
                <input type="text" class="form-control input-sm required" id="txtactualprice" name="txtactualprice" placeholder="" >
              </div>
            </div>
            <div class="form-group">
              <label style="margin-top:7px;padding:0 1px 0 0;text-align:right;" class="col-sm-7 control-label">Actual FC%:</label>
              <div style="padding-left:0px;margin-bottom:6px;" class="col-sm-4">
                <input type="text" class="form-control input-sm required" id="txtactualfc" name="txtactualfc" placeholder="" disabled="disabled" style="cursor:text">
              </div>
            </div>
          </div>
          <div style="margin-left:0px;padding-left:0px;padding-right:0px;" class="col-md-3">
            <div class="form-group">
              <label style="margin-top:7px;padding:0 1px 0 0;text-align:right;" class="col-sm-7 control-label">Desired Price :</label>
              <div style="padding-left:0px;margin-bottom:6px;" class="col-sm-4">
                <input type="text" class="form-control input-sm required" id="txtdesiredprice" name="txtdesiredprice" placeholder="" disabled="disabled" style="cursor:text">
              </div>
            </div>
            <div class="form-group">
              <label style="margin-top:7px;padding:0 1px 0 0;text-align:right;" class="col-sm-7 control-label">Desired FC% :</label>
              <div style="padding-left:0px;margin-bottom:6px;" class="col-sm-4">
                <input type="text" class="form-control input-sm required" id="txtdesiredfc" name="txtdesiredfc" placeholder="" >
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer" style="margin-top:2px;padding:2px;"> 
       
      <div id="dvDate" style="float:left;margin-top:8px;"></div>
         <span id="btnPrintDetails" type="button" class="btn btn-primary" style="width:90px;">Print</span>  
        <span id="btnCancel" type="button" class="btn btn-default" data-dismiss="modal" style="width:90px;">Close</span> 
        
        
        </div>
      </div>
      <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog --> 
  </div>
  <!--End details modal--> 
  
</div>

<div id="prt-container" class="" style="">

  <table width="946px" border="0" cellpadding="2" cellspacing="2" class="tblclear">
    <tr style="border-bottom:solid 1px #999;">
      <td colspan="5"><b id="plblrecipename"></b></td>
    </tr>
    <tr>
      <td><span class="modal-title">Category :</span><span id="plblcat"></span></td>
      <td ><span class="modal-title">Preparation Time :</span><span id="plblpreptime"></span></td>
      <td ><span class="modal-title">Adjusted Yield :</span><span id="plbladjustyield"></span></td>
      <td ><span class="modal-title">Adjusted Serving Size :</span><span id="plbladjustsize"></span></td>
      <td width="1%">&nbsp;</td>
    </tr>
    <tr>
      <td><span class="modal-title">Standard Yield :</span><span id="psyield"></span></td>
      <td ></td>
      <td ><span class="modal-title">Conversion Factor :</span><span id="plblfactor1"></span></td>
      <td ><span class="modal-title">Conversion Factor :</span><span id="plblfactor2"></span></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><span class="modal-title">Serving Size :</span><span id="pssize"></span></td>
      <td colspan="4">Serving Instruction :<span id="plblinst"></span></td>
    </tr>
    <tr>
      <td colspan="5">
      
      <div style="padding-top:9px;" class="grd">
      <table id="tblingpd" >
      </table>
      </div>
      
      </td>
    </tr>
  </table>
</div>
