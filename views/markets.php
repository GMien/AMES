<div class="innercontent">
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Market List</h3>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-12">
            <div class="well jqg" style="margin-bottom:8px;">
              <form  id="form1" class="form-horizontal" role="form">
                <div class="row">
                  <div class="col-md-8">
                    <div class="highlight">
                      <div class="form-group" style="margin-bottom:0px;">
                        <div>
                          <label  class="col-sm-1 control-label">Date:</label>
                          <div class="col-sm-3">
                            <input id= "datepicker" name="datepicker" type="text" class="form-control required date">
                          </div>
                        </div>
                        <div>
                          <label class="col-sm-1 control-label">Outlet</label>
                          <div class="col-sm-5">
                            <select style="" class="col-sm-5 form-control input-sm required" name="cboutlet" id="cboutlet">
                              <option value=""></option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="form-group" style="margin-bottom:0px;margin-top:4px;">
                        <label class="col-sm-1 control-label">Function</label>
                        <div class="col-sm-4">
                          <select  class="form-control input-sm required" name="cbfunction" id="cbfunction">
                            <option value=""></option>
                          </select>
                        </div>
                        <span id="btnOk" class="btn btn-info" style="width:80px;">OK</span> </div>
                    </div>
                    <hr class="hrx"/>
                    <div id="headinfo" class="highlight"> Outlet :<span id="lblOutlet" data-data="-1" class="sum" style="margin:0 12px 0 2px"></span> Date :<span id="lblDate" class="sum" style="margin:0 12px 0 2px"></span> Function :<span id="lblFunction"  data-data="-1" class="sum" style="margin:0 12px 0 2px"></span> </div>
                    <div class="form-group col-sm-12">
                      <div>
                        <div class="col-sm-6" style="padding-right:0px;">
                          <select style="" class="col-sm-5 form-control input-sm required" name="cbRecipe" id="cbRecipe"
                         >
                            <option value=""></option>
                          </select>
                        </div>
                      </div>
                      <div>
                        <div class="col-sm-2" style="padding-left:4px;padding-right:4px;">
                          <input id= "txtqt" name= "txtqt" type="text" class="form-control required number" placeholder="Quantity">
                        </div>
                      </div>
                      <span id="btnAdd" <?php echo check_access("al")?> class="btn btn-default">Add</span> <span id="btnRemove" class="btn btn-default" <?php echo check_access("rl")?>>Remove</span> </div>
                    <div class="col-sm-8" >
                      <table id="tblGridRecipe">
                      </table>
                    </div>
                    <div class="form-group col-sm-4"> <span id="btnSave" class="btn btn-success" style="width:132px;margin-bottom:8px;" <?php echo check_access("al")?>>Save Data</span> <span id="btnPrint" class="btn btn-primary" style="width:132px;position:relative;bottom:0px; "<?php echo check_access("pl")?>>Print</span> </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <table id="tblGrid">
                    </table>
                  </div>
                </div>
              </form>
              <hr style="margin:4px 0 4px 0;border-top:groove 2px #eee" />
              <div id="tblGridPager"></div>
            </div>
          </div>
        </div>
        <hr style="margin-top:0px;margin-bottom:4px" />
      </div>
      <!--panel boddy--> 
      
    </div>
  </div>
</div>
</div>
<div id="prt-container" class="" style="">
ssss
</div>