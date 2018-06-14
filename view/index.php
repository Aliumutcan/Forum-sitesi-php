


<div class="row icerik">
  <div class="col-md-12">
     <div class="panel-group">
      <div class="panel panel-default">





        <?php
          $tut;
          for ($i=0; $i <count($_GET["konular"]) ; $i++) {
              $tut=$_GET["konular"][$i]["kategori_id"];
        ?>

            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" href="#collapse<?php echo $_GET["konular"][$i]["kategori_id"]?>">
                  <?php  
                    foreach ($_GET["kategoriler"] as $value) {
                      if($value["id"]==$_GET["konular"][$i]["kategori_id"])
                        {
                          echo $value["kategori_adi"];
                          break;
                        }
                    }
                  ?>
                    
                  </a>
                  <div class="col-md-2" style="float: right;">
                    <form style="position: relative; z-index: 10;" method="GET" action="<?php echo '1/'.$value['id'].'/'.Url_Duzenle($value['kategori_adi']).'.html'; ?>">
                      <input type="submit" value="Tümünü Gör...">
                    </form>
                  </div>
              </h4>
            </div>
            <div id="collapse<?php echo $_GET["konular"][$i]["kategori_id"]?>" class="panel-collapse collapse">
            <?php
              while ($i<count($_GET["konular"]) && $tut==$_GET["konular"][$i]["kategori_id"]) {
            ?>
              
                <div class="panel-body">
                  <div class="col-md-4"><a href="<?php echo Kok_Dizine_Yonlendir().'konu-icerik/'.$_GET["konular"][$i]['id'].'/1/'.Url_Duzenle($_GET["konular"][$i]["baslik"]) ?>.html" ><?php echo $_GET["konular"][$i]["baslik"];?></a></div>
                  
                  <div class="col-md-4"><?php echo "Başlık sahibi: ".$_GET["konular"][$i]["kullanici"];?></div>
                  <div class="col-md-4"><?php echo "Toplam Cevap: ".$_GET["konular"][$i]["yanit"];?></div>
                </div>
              
            <?php
                $tut=$_GET["konular"][$i]["kategori_id"];
                $i++;
              }
              $i--;
            ?>
            </div>
        <?php
          }
        ?>

      </div>
    </div> 
  </div>
</div>
<div class="row">
  <?php
    include("sayfa_numaralari.php");
    Sayfalama(0,0);
  ?>
</div> 


