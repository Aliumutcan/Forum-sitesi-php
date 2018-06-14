<div class="container">
	<div class="row" >
	 	<div class="col-md-12">
	 		<form method="post" action="../yeni-konu-olustur.html"> 
        <?php 
          if(isset($_GET["konu_id"])){
        ?>
          <input type="hidden" name="konu_id" value="<?php echo $_GET['konu_id']; ?>">
          <input type="hidden" name="baslik" value="">
          <input type="hidden" name="kategori" value="0">

        <?php
          }else{
        ?>
          <input type="hidden" name="konu_id" value="0">

          <div class="form-group">
                    
                    <label for="baslik">Başlık</label>
                    <?php
                      if(isset($_GET["guncellenecek"])){
                    ?>
                        <input type="hidden" name="id" value="<?php echo $_GET['guncellenecek'][0]['id'];?>">
                        <input type="text" class="form-control" name="baslik" id="baslik" aria-describedby="emailHelp" placeholder="Başlık giriniz..." value="<?php echo $_GET['guncellenecek'][0]['baslik']; ?>">
                    <?php
                      }else{
                    ?>
                        <input type="hidden" name="id" value="0">
                        <input type="text" class="form-control" name="baslik" id="baslik" aria-describedby="emailHelp" placeholder="Başlık giriniz...">
                    <?php

                      }
                    ?>
                    
                  </div>
                  
                     <?php
                        if (!isset($_GET["kategoriler"])) {
                      ?>

                        <label for="Kategori">Kategori Yok</label>
                      <?php
                        }
                        else{
                          ?>
                            <div class="form-group">
                              <label for="Kategori">Kategori</label>
                              <select class="form-control" id="Kategori" name="kategori">
                          <?php
                          foreach ($_GET["kategoriler"] as $value) {
                      ?>
                            <option value="<?php echo($value['id']) ?>"><?php echo $value["kategori_adi"]; ?></option>
                      <?php
                          }
                          ?>
                           </select>
                            </div>
                          <?php
                        }
                        
                      ?>

        <?php

          }
        ?>
        

                 
                  <div class="form-group">
                    <label for="durum">Durum</label>
                    <select class="form-control" id="durum" name="durum">
                      <option value="1">Acik</option>
                      <option value="0">Kapalı</option>
                    </select>
                  </div>
                  
                  <div class="form-group" >
                    <label for="icerik">İcerik</label>
                    <script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
                    <?php 
                    	if(isset($_GET["guncellenecek"])){?>
                    		<textarea id="icerik" class="form-control" name="icerik"><?php echo $_GET['guncellenecek'][0]['icerik']; ?></textarea>
                    <?php
                    	}else{
                    		?>
                    		<textarea id="icerik" class="form-control" name="icerik"></textarea>
                    		<?php
                    	}
                    
                    ?>
                    
                    <script>
                      CKEDITOR.replace( 'icerik' );
                    </script>
                  </div>
                  <div class="form-group"><input type="submit" class="form-control btn btn-primary" value="Gönder"/></div>
                  
                </form>
	 	</div>
	</div>
</div>
