
<?php 
  $kullanici=$_SESSION["kullanici"];

  if (!isset($_SESSION["kullanici"])) {
    header("Location:../anasayfa.html");
  }
  $konular=$_GET["konular"];
  $gelen_mesajlar=$_GET["gelen_mesajlar"];
  $giden_mesajlar=$_GET["giden_mesajlar"];
  
?>


      <!--icerik-->
      <div class="row icerik">
        <div class="col-md-12">
          <!-- profil-->
          <div class="row prof-banner">
            <div class="col-md-3">
              <img src="<?php echo Kok_Dizine_Yonlendir().$kullanici[0]['resim'];?>" width="150" height="150">
            </div>
            <div class="col-md-5">
              <div class="row"><h4><?php echo $kullanici[0]["adi"]." ".$kullanici[0]["soyadi"] ?></h4></div>
              <div class="row"><?php echo $kullanici[0]["unvan"] ?></div>
              <div class="row">Kayit Tarihi: <?php echo $kullanici[0]["kayit_tarihi"] ?></div>
              <div class="row">
                <div id="accordion">
                  <div class="card">
                    <div class="card-header" id="headingOne">
                      <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          Resim ekle/değiş
                        </button>
                      </h5>
                    </div>

                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                      <div class="card-body">
                        <form action="resim-ekle-degis.html" method="POST" enctype="multipart/form-data">
                          <input type="file" name="dosya" />
                          <input type="submit" value="Resim ekle/değiş" />
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                
              </div>
               <div class="row">
                <?php
                  if ($kullanici[0]["unvan"]=="Yönetici") {
                ?>
                <a class="nav-item nav-link" href="<?php echo '../'.Kok_Dizine_Yonlendir().'kategori-duzenle.html' ?>" ><BUTTON class="btn btn-secondary">Kategori Düzenle</BUTTON></a>
                <a class="nav-item nav-link" href="<?php echo '../'.Kok_Dizine_Yonlendir().'sikayetler.html' ?>" ><BUTTON class="btn btn-secondary">Şikayetler</BUTTON></a>
                 <a class="nav-item nav-link" href="<?php echo '../'.Kok_Dizine_Yonlendir().'engelliler.html' ?>" ><BUTTON class="btn btn-secondary">Engelliler</BUTTON></a>
                <?php
                  }
                ?>
                                 
               </div>
            </div>
          </div>
          <!--menu -->
          <div class="row">
            <nav>
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link" href="<?php echo '../'.Kok_Dizine_Yonlendir().'1/metinlerim.html' ?>" >Forum Metinlerim</a>
                <a class="nav-item nav-link active" id="nav-contact-tab" data-toggle="tab" href="#nav-gelenkutusu" role="tab" aria-controls="nav-contact" aria-selected="false">Gelen Kutusu</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-gidenktusus" role="tab" aria-controls="nav-contact" aria-selected="false">Giden Kutusu</a>
                <a class="nav-item nav-link" href="<?php echo Kok_Dizine_Yonlendir().'yeni-konu-olustur.html'?>" >Yeni Konu Olustur</a>

              </div>
            </nav>
            

          </div>
          <!--Menu içerikleri-->
          <div class="row">
            <div class="tab-content" id="nav-tabContent">
              
              <div class="tab-pane fade" style="overflow-x: hidden; padding-left: 20px;" id="nav-gelenkutusu" role="tabpanel" aria-labelledby="nav-contact-tab">
                <?php 
                  if (!isset($gelen_mesajlar)) {
                    echo "Gelen mesajınız bulunmamaktadır.";
                  }else{
                    foreach ($gelen_mesajlar as $value) {
                ?>

                    <div class="row">
                      <div class="col-md-4">
                        <button type="button" class="btn btn-secondary float-left" >
                        <?php
                        	if ($value["durum"]=="1") {
                        ?>
                        	 <span class="glyphicon glyphicon-open" aria-hidden="true">Okunmadı</span>
                        <?php
                        		
                        	}else{
                        ?>
                        	 <span class="glyphicon glyphicon-open" aria-hidden="true">Okundu</span>
                        <?php

                        	}
                        ?>
                        </button>
                        
                        
                      </div>
                      <div class="col-md-4"><?php echo $value["baslik"] ?></div>  
                      <div class="col-md-2">
                        <form method="GET" action="<?php echo Kok_Dizine_Yonlendir().$value['id'].'/mesaj-detay.html' ?>">
                          <button type="sumbit" class="btn btn-secondary float-left" >
                            <span class="glyphicon glyphicon-open" aria-hidden="true">oku</span>
                          </button>
                        </form>
                      </div>       
                      <div class="col-md-2">
                      	<form method="POST" action="mesaj-sil.html">
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
              <div class="tab-pane fade" style="overflow-x: hidden; padding-left: 20px;" id="nav-gidenktusus" role="tabpanel" aria-labelledby="nav-contact-tab">
                <?php
                  if (!isset($giden_mesajlar)) {
                    echo "Göndemiş oluduğunuz herhangi bir mesaj yok";
                  }
                  else{
                    foreach ($giden_mesajlar as $value) {
                ?>

                      <div class="row">
                      
                      <div class="col-md-4"><?php echo $value["baslik"] ?></div>  
                      <div class="col-md-3">
                        <form method="GET" action="<?php echo Kok_Dizine_Yonlendir().$value['id'].'/mesaj-detay.html' ?>">
                          <button type="sumbit" class="btn btn-secondary float-left" >
                            <span class="glyphicon glyphicon-open" aria-hidden="true">oku</span>
                          </button>
                        </form>
                      </div>       
                      <div class="col-md-3">
                        <form method="POST" action="mesaj-sil.html">
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

        </div>
      </div>



     