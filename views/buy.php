<div class="container maincontent">
  
  



  <div class="row"> 
  <form id="paypalform"  name="paypalform" action="<?php echo $paypalurl ?>" method="post" > 
   <div class="col-md-8 col-md-offset-2">
   
    <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Redirect To PayPal</h3>
                </div>
                <div class="panel-body" style="text-align:center;">
                   <b>Redirecting to PayPal. Please wait...</b>
                   
                </div>
                <div class="panel-footer" style="text-align:center;">
                    <input type="submit" class="btn btn-primary" style="" role="button" value="Redirect Now"/>
                    </div>
            </div>
            
            </div>
            
      
	  <input type="hidden" name="cmd" value="_xclick">
	  <input type="hidden" name="charset" value="utf-8">
	  <input type="hidden" name="currency_code" value="USD">
	  <input type="hidden" name="return" value="<?php echo site_url('paypal/success')?>">
	  <input type="hidden" name="notify_url" value="<?php echo site_url('paypal/ipn')?>">
	  <input type="hidden" name="cancel_return" value="<?php echo site_url('paypal/cancel')?>">
	  <input type="hidden" name="amount" value="<?php echo $price ?>">
	  <input type="hidden" name="item_name" value="<?php echo $item ?>">
	  <input type="hidden" name="item_number" value="<?php echo $payid ?>">
	  <input type="hidden" name="custom" value="15">
	  <input type="hidden" name="rm" value="1">
	  <input type="hidden" name="business" value="<?php echo $paypalemail ?>">   
      </form>
    
  </div>

  
</div>
<!--/container-->