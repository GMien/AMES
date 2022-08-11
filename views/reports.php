<div class="innercontent">
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Reports</h3>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-12">
          
          <!-- Nav tabs -->
<ul class="nav nav-tabs" id="tabs">
  <li><a href="#tab1" data-toggle="tab" <?php echo check_access("vmp")?>>Merchandise Master</a></li>
  <li><a href="#tab2" data-toggle="tab" <?php echo check_access("vrp")?>>Recipes Master</a></li>
  <li><a href="#tab3" data-toggle="tab" <?php echo check_access("vlp")?>>Market List Summary</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  
  <div class="tab-pane active" id="tab1">
  
  <div class="row">
            <div class="col-md-12">
            <div style="margin-bottom:8px;" class="well">
              <form role="form" class="form-inline">
                <label class="control-label" for="cbTypes">Type:</label>
                <div class="form-group ">
                  <select style="width:180px" class="form-control input-sm" id="cbTypes">
                    <option value="-1">All</option></select>
                  <span class="btn btn-primary" id="btnFilter" data-data=""><i class="fa fa-filter">&nbsp;</i>Filter</span> </div>
              </form>
             
              </div>
               <div class="jqg">
              <table id="tblGrid" class="">
            </table>
            </div>
            
            </div>
            
            
            
            <div class="col-md-12" style="padding:8px 14px 8px 0;">
            <span style="width:132px;position:relative;bottom:0px;float:right;" class="btn btn-primary" id="btnPrint1">Print</span>
            <div class="clear"></div>
            </div>
            
          </div>
  
  
  </div>
  
  <div class="tab-pane" id="tab2">
  
  <div class="row">
            <div class="col-md-12">
            <div style="margin-bottom:8px;" class="well">
              <form role="form" class="form-inline">
                <label class="control-label" for="cbTypes">Type:</label>
                <div class="form-group ">
                  <select style="width:180px" class="form-control input-sm" id="cbTypes2">
                    <option value="-1">All</option></select>
                  <span class="btn btn-primary" id="btnFilter2" data-data=""><i class="fa fa-filter">&nbsp;</i>Filter</span> </div>
              </form>
             
              </div>
               <div class="jqg">
              <table id="tblGrid2" class="">
            </table>
            </div>
            
            </div>
            
            <div class="col-md-12" style="padding:8px 14px 8px 0;">
            <span style="width:132px;position:relative;bottom:0px;float:right;" class="btn btn-primary" id="btnPrint2">Print</span>
            <div class="clear"></div>
            </div>
          </div>
  </div>
  
  
  
  <div class="tab-pane" id="tab3">
  
  <div class="row">
            <div class="col-md-12">
            <div style="margin-bottom:8px;" class="well">
              <form id="frmmarket" role="form" class="form-inline">
               
               <div>
               <label class="control-label" for="cboutlet">Outlet</label>
                          
                          <div class="form-group" style="margin-right:16px;">
                          <div>
                            <select style="width:220px" class="form-control input-sm required " name="cboutlet" id="cboutlet">
                              <option value=""></option>
                            </select>
                            </div>
                          </div>
                          <label class="control-label" for="cbDivision">Division</label>
                          
                          <div class="form-group">
                          <div>
                            <select style="width:220px" class="form-control input-sm required" name="cbDivision" id="cbDivision">
                              <option value=""></option>
                            </select>
                            </div>
                          </div>
                          </div>
                          
                          
                          <div style="margin-top:12px;">
                          <label class="control-label" >From</label>
                          <div class="form-group" style="margin-right:16px;">

                            <input type="text" style="width:120px;" class="form-control required date col-sm-2" name="dtfrom" id="dtfrom">
                           
                          </div>
                          
                          <label class="control-label" >To</label>
                          <div class="form-group" style="margin-right:16px;">

                            <input type="text" style="width:120px;" class="form-control required date col-sm-2" name="dtto" id="dtto">
                           
                          </div>
                          <span class="btn btn-primary" id="btnSearch" data-data=""><i class="fa fa-search">&nbsp;</i>Search...</span>
                          </div>
                     
                        
              </form>

              
             <div class="clear"></div>
              </div>
               <div class="jqg">
              <table id="tblGrid3" class="">
            </table>
            </div>
            
            </div>
            
            
            
            <div class="col-md-12" style="padding:8px 14px 8px 0;">
            <span style="width:132px;position:relative;bottom:0px;float:right;" class="btn btn-primary" id="btnPrint3">Print</span>
            <div class="clear"></div>
            </div>
            
          </div>
          
  </div>



</div>
          
          
          </div>
        </div>
        
      </div>
      <!--panel boddy--> 
      
    </div>
  </div>
</div>
</div>
