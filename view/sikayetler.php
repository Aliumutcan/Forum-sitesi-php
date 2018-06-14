
      <!--icerik-->
      <div class="row icerik">
        <form method="POST" action="<?php echo Kok_Dizine_Yonlendir().'sikayet-islemleri.html';?>">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-12">
              <input type="submit" class="btn btn-danger" aria-label="Left Align" value="Seçili Olanları kaldır" />
            </div>
          </div>
          <?php
          if (!isset($_GET["sikayetler"])) {
            echo "Hiçbir şikayet bulunamadı.";
          }else{
            $sayac=0;
            foreach ($_GET["sikayetler"] as $value) {
          ?>
            <div class="row" >

              <div class="col-md-1"><input type="checkbox" name="id[]" value="<?php echo $value['id']; ?>" class="form-check-input"></div>
              <div class="col-md-5">
                <?php echo substr($value["aciklama"], 0,15); ?>
              <br>
                <button type="button" class="btn btn-secondary" data-toggle="collapse" data-target="#demo<?php echo $value['id']?>">....</button>

                <div style="margin-bottom: 130px;" id="demo<?php echo $value['id']?>" class="collapse col-md-5">
                  <?php echo $value["aciklama"]; ?>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-control">
                          <label>Engel zamanı</label>
                          <input type="date" name="tarih">
                          <input type="hidden" name="kullanici_id" value="<?php echo $value['sikayet_edilen_id'];?>">
                          <label>Engel Tipi</label>
                          <select name="engel_tipi">
                            <option value="">Engel yok</option>
                            <option value="konu-acma">Konu acma engeli</option>
                            <option value="mesaj-yazma">Mesaj yazma engeli</option>
                          </select>
                          <input type="hidden" name="sikayet_id" value="<?php echo $value['id'];?>">
                          <input type="submit" name="" class="btn btn-danger" value="Engeli Uygula">
                      </div>
                      

                    </div>
                  </div>
                </div> 

              </div>
              <div class="col-md-5">
                <a href="<?php echo Kok_Dizine_Yonlendir().$value['link'];?>"><button type="button" class="btn btn-success" aria-label="Left Align"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button></a>
          <?php
              if($value["durum"]=="true"){
          ?>
                <button type="button" class="btn btn-danger" aria-label="Left Align">işlem yapılmadı</button>
          <?php
              }else{
          ?>
                <button type="button" class="btn btn-danger" aria-label="Left Align">işlem yapıldı</button>
          <?php
              }
          ?>
                

              </div>

            </div>
          <?php
            $sayac++;
            }
          }
          ?>
          
        </div>
        </form>
      </div>
<!--

      <div class="row icerik">
        <form method="POST" action="<?php echo Kok_Dizine_Yonlendir().'sikayet-islemleri.html';?>">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-12">
              <input type="submit" class="btn btn-danger" aria-label="Left Align" value="Seçili Olanları kaldır" />
            </div>
          </div>
          <?php
          if (!isset($_GET["sikayetler"])) {
            echo "Hiçbir şikayet bulunamadı.";
          }else{
            $sayac=0;
            foreach ($_GET["sikayetler"] as $value) {
          ?>
          <div class="row">

            <div class="col-md-1"><input type="checkbox" name="id" value="<?php echo $value['id']; ?>" class="form-check-input"></div>
            <div class="col-md-7">
              <?php echo substr($value["aciklama"], 0,50); ?>
            <br>
              <button type="button" class="btn btn-secondary">Devamını Gör....</button>

            </div>
            <div class="4">
              <a href="<?php echo Kok_Dizine_Yonlendir().$value['link'];?>"><button type="button" class="btn btn-success" aria-label="Left Align"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button></a>

              <button type="button" class="btn btn-danger" aria-label="Left Align"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
            </div>

          </div>
          <div class="row">
            <div class="row">
              <?php echo $value["aciklama"]; ?>
            </div>
            <div class="row">
                  <div class="form-control">
                      <label>Engel zamanı</label>
                      <input type="date" name="tarih">
                      <input type="hidden" name="kullanici_id" value="<?php echo $value['sikayet_edilen_id'];?>">
                      <label>Engel Tipi</label>
                      <select name="engel_tipi">
                        <option value="">Engel yok</option>
                        <option value="konu-acma">Konu acma engeli</option>
                        <option value="mesaj-yazma">Mesaj yazma engeli</option>
                      </select>
                      <button type="submit" class="btn btn-danger" name="sira" value="<?php echo $sayac;?>" aria-label="Left Align">Engeli Uygula</button>
                  </div>
              </div>
              </div> 
          <?php
            $sayac++;
            }
          }
          ?>
          
        </div>
        </form>
      </div>
      -->