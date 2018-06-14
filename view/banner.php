<!doctype html>
<html lang="tr">
  <head>
    <title><?php echo $_SESSION["title"];?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../../../../../css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../../../../../../css/style.css">
    <link rel="stylesheet" href="../../../../../../css/style2.css">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="../../../../../../js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Hello, world!</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container">
      <!--munu-->
      <div class="row menu center">
        <div class="col-md-2">Logo</div>
        <div class="col-md-4">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="ARA" aria-label="Recipient's username" aria-describedby="basic-addon2">
            <div class="input-group-append">
              <span class="input-group-text" id="basic-addon2">Ara</span>
            </div>
          </div>
        </div>
        <div class="col-md-1"><a href="<?php echo Kok_Dizine_Yonlendir().'anasayfa.html'?>">AnaSayfa</a></div>
        <div class="col-md-1">Forum</div>
        <div class="col-md-1">Blog</div>
        <div class="col-md-1">
          <?php
          session_start();
            
            if (isset($_SESSION['kullanici'])) { ?>
              
              <div class="btn-group">
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Hoşgeldin <?php echo $_SESSION['kullanici'][0]["adi"].' '.$_SESSION['kullanici'][0]["soyadi"];?>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="<?php echo Kok_Dizine_Yonlendir().'profil.html'; ?>">Profil</a>
                  <a class="dropdown-item" href="<?php echo Kok_Dizine_Yonlendir().'yeni-konu-olustur.html'?>">Yeni konu oluştur</a>
                  
                  <a class="dropdown-item" href="<?php echo '../'.Kok_Dizine_Yonlendir().'1/metinlerim.html' ?>" >Forum Metinlerim</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="cikis.html">Çıkış</a>
                </div>
              </div>

            <?php }else {?>
            
         

            <div class="dropdown">
              <div class="btn btn-secondary dropdown-toggle" id="dropdownMenu2" data-toggle="dropdown">
                Giriş
              </div>
              <form action="<?php echo Kok_Dizine_Yonlendir().'giris.html'?>" method="post" id="fileForm" role="form">
              <div class="dropdown-menu">
                <div class="dropdown-item">
                  <form class="px-4 py-3">
                    <div class="form-group">
                      <label for="exampleDropdownFormEmail1">Mail Adresiniz</label>
                      <input type="email" class="form-control" name="eposta" id="exampleDropdownFormEmail1" placeholder="email@example.com">
                    </div>
                    <div class="form-group">
                      <label for="exampleDropdownFormPassword1">Şifre</label>
                      <input type="password" class="form-control" name="sifre" id="exampleDropdownFormPassword1" placeholder="Şifre">
                    </div>
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="dropdownCheck">
                      <label class="form-check-label" for="dropdownCheck">
                        Beni Hatırla
                      </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Giriş</button>
                  </form>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="yeni-kayit.html">Yeni kayıt</a>
                  <a class="dropdown-item" href="#">Şifremi unuttum</a>
                </div>
                
              </div>
            </form>
            </div>

          <?php }?>
        </div>
      </div>
