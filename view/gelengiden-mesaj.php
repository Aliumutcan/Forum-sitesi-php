
      <!--icerik-->
      <div class="row">
        <div class="row gelen-mesaj">
          <div class="col-md-8">
<!--
            <?php
              foreach ($_GET["mesajlar"] as $value) {
            ?>

            <div class="row">
              <div class="row ">
                <div class="col-md-12">
                  <?php
                    if($_SESSION["kullanici"][0]["id"]==$value["alan_id"]){
                  ?>
                  <div class="btn btn-success"><a href="<?php echo Kok_Dizine_Yonlendir().$value['id'].'/mesaj-detay/gelen.html'?>"><?php echo $value["baslik"];?></a></div>
                  <?php
                    }else{
                  ?>
                  <div class="btn btn-danger"><a href="<?php echo Kok_Dizine_Yonlendir().$value['id'].'/mesaj-detay/giden.html'?>"><?php echo $value["baslik"];?></a></div>
                  <?php
                    }
                  ?>
                
                <div class="float-right">Tarihi: <?php echo $value["tarih"];?> </div>
              </div>
              </div>
              
            </div>
            <?php

              }
            ?>

-->
            





            
          </div>
          <?php 
            if (isset($_POST["kullanici_id"])) {
          ?>
          <form method="POST" action="<?php echo Kok_Dizine_Yonlendir().'yeni-mesaj-olustur.html';?>">
           <div class="col-md-10">
              <div class="row">
                <div class="row">
                  <table class="table">
                      <tr>
                        <td>Kullanıcı adı:<input type="hidden" name="kullanici_id" value="<?php echo $_POST['kullanici_id']; ?>"></td>
                        <td><input type="text"  disabled value="<?php echo $_POST['kullanici_adi']; ?>" class="form-control"></td>
                      </tr>
                      <tr>
                        <td>Konu:</td>
                        <td><input type="text" name="baslik" class="form-control"></td>
                      </tr>
                    </table>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <textarea name="icerik">Mesajınız</textarea><br>
                  <input type="submit" class="btn btn-danger" value="Gönder" name="">
                </div>
              </div>
              
            </div>
          </form>
          <?php   
            }
          ?>
          
         


        </div>
        
      </div>
