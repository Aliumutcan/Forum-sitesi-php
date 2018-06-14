<script type="text/javascript">
	
   setTimeout(function(){
    $('#hata').remove();
  }, 5000);
      
</script>
	<?php   
	$hatakodu=$_SESSION["Hata_kodu"];
  $hata_mesaji=$_SESSION["hata_mesaji"];
  if(!isset($hatakodu))
    return;
	if($hatakodu==1){ ?>
<div class="container">
  <div id="hata" style="text-align:center;
  z-index:10; 
   position: fixed;
  top: 50%;
  left: 50%;
  margin-top: -200px;
  margin-left: -200px;" class="alert alert-success">
    <strong><?php echo $hata_mesaji;?></strong>
  </div>
  <?php }else if($hatakodu==-1){ ?>
  <div onLoad="removeDummy();" id="hata" style="text-align:center;
  z-index:10; 
    position: fixed;
  top: 50%;
  left: 50%;
  margin-top: -200px;
  margin-left: -200px;" class="alert alert-danger">
    <strong><?php echo $hata_mesaji;?></strong>
	 
  </div>
  <?php }else if($hatakodu==0){ ?>
  <div id="hata" style="text-align:center;
  z-index:10; 
    position: fixed;
  top: 50%;
  left: 50%;
  margin-top: -200px;
  margin-left: -200px;" class="alert alert-warning">
    <strong><?php echo $hata_mesaji;?></strong>
  </div>
  <?php } 
  

  ?>

