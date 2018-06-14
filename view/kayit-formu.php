
      <!--icerik-->
      <div class="row icerik">
        <div class="col-md-12">
            <form action="" method="post" id="fileForm" role="form">
              <fieldset><legend class="text-center">FORUM KAYIT SAYFASI <span class="req"><small> </small></span></legend>

              <div class="form-group">
                <div class="form-group">
                  <label for="email"><span class="req">* </span> Email: </label> 
                        <input class="form-control" required type="text" name="eposta" id = "email"  onchange="email_validate(this.value);" />   
                            <div class="status" id="status"></div>
                  </div>

                  <div class="form-group">
                      <label for="password"><span class="req">* </span> Şifreniz: </label>
                          <input required name="sifre" type="password" class="form-control inputpass" minlength="4" maxlength="16"  id="pass1" /> </p>

                      <label for="password"><span class="req">* </span> Şifrenizi Tekrarlayın: </label>
                          <input required name="sifre2" type="password" class="form-control inputpass" minlength="4" maxlength="16"   id="pass2" onkeyup="checkPass(); return false;" />
                              <span id="confirmMessage" class="confirmMessage"></span>
                  </div>

                  <div class="form-group">   
                      <label for="firstname"><span class="req">* </span> Adınız: </label>
                          <input class="form-control" type="text" name="adi" id = "txt" onkeyup = "Validate(this)" required /> 
                              <div id="errFirst"></div>    
                  </div>

                  <div class="form-group">
                      <label for="lastname"><span class="req">* </span> Soyadınız: </label> 
                          <input class="form-control" type="text" name="soyadi" id = "txt" onkeyup = "Validate(this)" required />  
                              <div id="errLast"></div>
                  </div>

              

              

                  <div class="form-group">
                  
                      <input type="hidden" value="<?php //echo $date_entered; ?>" name="dateregistered">
                      <input type="hidden" value="0" name="activate" />
                      <hr>

                      <input type="checkbox" required name="haberdar_olmak_istiyorum" onchange="this.setCustomValidity(validity.valueMissing ? 'Please indicate that you accept the Terms and Conditions' : '');" id="field_terms">   <label for="terms">Haberdar olmak istiyorum.</label><span class="req">* </span>
                  </div>

                  <div class="form-group">
                      <input class="btn btn-success" type="submit" name="submit_reg" value="Kaydet">
                  </div>
   
              </div>
            </fieldset>
          </form><!-- ends register form -->

        </div>

      </div>

  