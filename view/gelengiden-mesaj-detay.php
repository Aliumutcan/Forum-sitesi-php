
      <!--icerik-->
      <div class="row">
        <div class="row gelen-mesaj">
          <div class="col-md-8">

            <?php
              foreach ($_GET["mesajlar"] as $value) {
            ?>
              <div class="row">
                <div class="row">
                  <div class="col-md-12">
                    <p><?php echo $value["icerik"]; ?></p>
                  </div>
                </div>
                <div class="row ">
                  <div class="col-md-12">
                    <?php
                      if($_SESSION["kullanici"][0]["id"]==$value["alan_id"]) {
                    ?>
                    <div class="btn btn-success">Gelen</div>
                    <?php
                        
                      }else{
                    ?>
                      <div class="btn btn-danger">Giden</div>
                    <?php

                      }
                    ?>
                  <div class="float-right">Gönderme tarihi <?php echo $value["tarih"]?> </div>
                </div>
                </div>
                
              </div>
            <?php
              }
            ?>

            

            
          </div>
          
            <div class="col-md-4">
              <form method="POST" action="<?php echo Kok_Dizine_Yonlendir().'yeni-mesaj-olustur.html';?>">
              <!--<div class="row">
                <div class="col-md-12"><input type="button" class="btn btn-secondary" data-toggle="collapse" data-target="#demo" value="Yeni Mesaj Oluştur"></div>
                <div class="col-md-12">
                  <div id="demo" class="collapse">
                    <table class="table">
                      <tr>
                        <td>Kullanıcı adı:</td>
                        <td><input type="text" name="" class="form-control"></td>
                      </tr>
                      <tr>
                        <td>Konu:</td>
                        <td><input type="text" name="" class="form-control"></td>
                      </tr>
                    </table>
                  </div> 
                </div>
              </div>-->
              <div class="row">
                <div class="col-md-12">
                  <textarea name="icerik">Mesajınız</textarea><br>
                  <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
                  <input type="hidden" name="gonderen_id" value="<?php echo $_GET["gonderilecek"];?>">
                  <input type="submit" class="btn btn-danger" value="Gönder" />
                </div>
              </div>
              </form>
            </div>
          



        </div>
        
      </div>
