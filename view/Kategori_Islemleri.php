
<div class="container">
	<div class="row">
		<form method="POST" action="<?php echo Kok_Dizine_Yonlendir().'kategori-ekle.html';?>">
			
		
			<div class="row">Kategori Adı: <input type="text" name="kategori_adi"></div>
			<div class="row">Acıklama: <input type="text" name="aciklama"></div>
			<div class="row">
				<button type="sumbit" class="btn btn-success" aria-label="Left Align">
					Ekle
			    </button>  
			</div>
		</form>
	</div>
	<div class="row" >
	 	<div class="col-md-12">
			<?php
		    if (!isset($_GET["kategoriler"])) {
		    	echo "Henüz açmış olduğunuz bir başlık yok";
		    }else{
		    	foreach ($_GET["kategoriler"] as $value) {
		    ?>

		    <div class="row">
		        <div class="col-md-3"><?php echo $value["kategori_adi"];?></div>
		        <div class="col-md-6"><?php echo $value["aciklama"];?></div>
		        <div class="col-md-1">
		        	<button type="sumbit" onclick="ac(<?php echo $value['id'];?>);" class="btn btn-success" aria-label="Left Align">
		            	<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
			        </button>         
		    	</div>
		    	<div class="col-md-1">
		    		<form method="POST" action="<?php echo Kok_Dizine_Yonlendir().'kategori-sil.html'?>">
                      		<input name="id" type="hidden" value="<?php echo $value['id']?>" />
	                         <button type="sumbit" class="btn btn-danger" aria-label="Left Align">
					            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					        </button>
                    </form>
			       
		    	</div>
		    </div>

		    <div class="row" id="<?php echo $value['id']; ?>" style="display: none;">
		    	<form method="POST" action="<?php echo Kok_Dizine_Yonlendir().'kategori-guncelle.html';?>" >
		    		<input type="hidden" name="id" value="<?php echo $value['id'];?>">
			        <div class="col-md-3"><input type="text" name="kategori_adi" value="<?php echo $value["kategori_adi"];?>"></div>
			        <div class="col-md-6"><input type="text" name="aciklama" value="<?php echo $value["aciklama"];?>"></div>
			        <div class="col-md-1">
			        	
			        	<button type="sumbit" class="btn btn-success" aria-label="Left Align">
			        		Güncelle
				       	</button>
			        	        
			    	</div>
		    	</form> 
		    </div>
		    <?php
		    }
		        }
		                  
		    ?>
	                
		</div>
	</div>                
</div>

<script type="text/javascript">
	var tut=0;
	function ac(id) {
		if(tut>0){
			document.getElementById(tut).style.display = "none";
		}
		if(tut==id){
			document.getElementById(id).style.display = "none";
			tut=0;
			return;
		}
		document.getElementById(id).style.display = "block";
			tut=id;
		
	}
</script>