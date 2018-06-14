<?php
	$konu_verileri=$_GET["konu_verileri"];
?>
<div class="container">
	<?php
		if(!isset($_GET["konu_verileri"])){
	?>
		<h1>Hiç bir metin bulunamadı.</h1>
	<?php
		}
	?>
	<div class="row" >
	 	<div class="col-md-12">
			<?php
		    if (!isset($konular)) {
		    	echo "Henüz açmış olduğunuz bir başlık yok";
		    }else{
		    	foreach ($konu_verileri as $value) {
		    ?>

		    <div class="row">
		        <div class="col-md-6"><?php echo $value["baslik"];?></div>
		        <div class="col-md-3">Toplam mesaj sayısı: <?php echo $value["toplam_mesajlar"];?></div>
		        <div class="col-md-1">
		        	<form method="GET" action="<?php echo Kok_Dizine_Yonlendir().'yeni-konu-olustur/'.$value['id'];?>/guncelle.html">
		        		<button type="sumbit" class="btn btn-success" aria-label="Left Align">
		            		<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
			        	</button>
		        	</form>         
		    	</div>
		    	<div class="col-md-1">
		    		<form method="POST" action="<?php echo Kok_Dizine_Yonlendir().'metin-sil.html'?>">
                      		<input name="id" type="hidden" value="<?php echo $value['id']?>" />
	                         <button type="sumbit" class="btn btn-danger" aria-label="Left Align">
					            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					        </button>
                    </form>
			       
		    	</div>
		    </div>

		    <?php
		    }
		        }
		                  
		    ?>
	                
		</div>
	</div>                
</div>