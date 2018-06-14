
      <!--icerik-->
      <?php
        foreach ($_GET["konu_icerigi"] as $value) {
      ?>
        <div class="row icerik yazilar">
          <div class="col-md-12">

            <div class="row">
              <div class="col-md-2"><?php echo $value["kullanici"]["adi"]." ".$value["kullanici"]["soyadi"];?></div>
              <div class="col-md-5"><?php echo $value["baslik"];?></div>
              <div class="col-md-4">
                <form method="POST" action="<?php echo Kok_Dizine_Yonlendir().'begeni-ret.html' ?>">
                  <input type="hidden" name="id" value="<?php echo $value['id'] ?>">
                  <input type="submit" class="btn btn-success" value="Sevdim" name="button"/>
                  <input type="submit" class="btn btn-danger" value="Sevmedim" name="button"/>
                </form>  
              </div>
              <div class="col-md-1"><input type="submit" class="btn btn-secondary" onclick="ac(<?php echo $value['id'];?>)" value="Şikayet et" name="button"/></div>
            </div>

            <div class="row">
              <!-- yazıyı yazanın bilgileri-->
              <div class="col-md-2">
                <div class="row yazi-resim">
                  <img src="<?php echo Kok_Dizine_Yonlendir().$value['kullanici']['resim']; ?>" width="100" height="100">
                </div>
                <div class="row yazi-diger">Teşekkur sayısı: <?php echo $value["kullanici"]["tesekkur_sayisi"]; ?></div>
                <div class="row yazi-diger">Toplam acılan konular:<?php echo $value["kullanici"]["toplam_mesaj"];?></div>
                <div class="row yazi-diger">Tarih: <?php echo $value["tarih"];?></div>
                <div class="row yazi-diger">
                  <form action="<?php echo Kok_Dizine_Yonlendir().'yeni-mesaj-olustur.html'?>" method="POST">
                    <input type="hidden" name="kullanici_adi" value="<?php echo $value["kullanici"]["adi"];?>">
                    <input type="hidden" name="kullanici_id" value="<?php echo $value["kullanici"]["id"];?>">
                    <input type="submit" class="btn btn-primary row yazi-diger" value="Mesaj yaz">
                  </form>
                </div>
                
              </div>
              <!--yazı içeriği-->
              <div class="col-md-10 yazi-icerik" id="<?php echo $value['id']; ?>">
                <?php echo $value["icerik"];?>
              </div>
              


            </div>


          </div>
          
        </div>
      <?php
        }
      ?>
      

      <div class="row icerik yazilar">
        <form method="GET" class="row col-md-12" action="<?php echo Kok_Dizine_Yonlendir().'yeni-konu-olustur/'.$_GET['konu_icerigi'][0]['id'].'/html' ?>">
          
          <input type="submit" class="btn btn-secondary row yazi-diger col-md-12" name="" value="Konuyu Cevapla"/>
        </form>
      </div>

      <style type="text/css">
        .sikayet{
          position: fixed;
          top: 0px;
          left: 0px;
          width: 100%;
          height: 1000px;
          background-color: rgba(0,0,0,0.5);
          display: none;
        }
        .sikayet .row{
          width: 40%;
          margin-top: 150px;
          background-color: white;
          padding: 5px;
          border: 2px solid blue;
          margin-right: auto;
          margin-left: auto;
          -webkit-border-radius: 5px;
          -moz-border-radius: 5px;
          border-radius: 5px 5px 5px 5px;
          z-index: 10;
        }
        .kapa{
          float: right;
          z-index: 11;
        }
      </style>

      <div class="sikayet" id="sikayet" >

        <form method="POST" action="<?php echo Kok_Dizine_Yonlendir().'sikayet-olustur.html'?>">
          
          <div class="row">
            <div class="kapa" onclick="kapa();"><img width="35" height="35" src="<?php echo Kok_Dizine_Yonlendir().'img/exit.png';?>"></div>

            <input type="hidden" name="sikayet_edilen_id" id="sikayet_edilen_id" value="0">
            <h3><span class="label label-default">Acıklama</span></h3>
            <textarea class="form-control" rows="5" name="aciklama">Acıklama</textarea>
            <input type="submit" class="btn btn-secondary" name="" value="Şikayet et">
          </div>
        </form>
      </div>

      <script type="text/javascript">
        function ac(id){
          document.getElementById("sikayet_edilen_id").setAttribute('value', id);
          document.getElementById("sikayet").style.display="block";
        }
        function kapa(){
          document.getElementById("sikayet").style.display = "none";
        }
      </script>


      