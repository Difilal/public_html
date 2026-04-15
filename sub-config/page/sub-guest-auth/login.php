        <div class="o-page__card" style="margin-top: 50px;">
            <div class="c-card u-mb-xsmall">
                <header class="c-card__header u-pt-large">
                    <div class="c-card__icon" href="#!" style="background:#475364;background: linear-gradient(180deg,#475364,#273142);">
                        <i class="fas fa-cog"></i>
                    </div>
                    <h1 class="u-h3 u-text-center u-mb-zero">App Config</br>
                        <small>PMPLAND<br>
                            <!-- <small><small>Belanja Hemat, Keluara Ceria</small></small> -->
                        </small><br>
                    </h1>
                </header>
				
				<div class="alert alert-warning" style="display: none;" role="alert" id="wrapper-alert">
				  <span id="text-alert" style="color:red;"></span>
				</div>
                
                <div id="form-login" class="c-card__body">
                    <div id="email-wrapper" class="c-field u-mb-small">
                        <label class="c-field__label focus-onload" for="email">Username</label> 
                        <input class="c-input" type="email" id="email" autocomplete="off" placeholder="Nohp atau Email">
                    </div>

                    <div id="password-wrapper" class="c-field u-mb-small">
                        <div class="c-field has-icon-right">
                            <label class="c-field__label" for="password">Password <?php //echo md7("123123"); ?></label> 
                            <input class="c-input pswd" type="text" id="password" autocomplete="off" placeholder="Password"> 
                            <span class="c-field__icon">
                                <i class="far fa-eye-slash u-pt-medium toggle-text-password cursor-pointer" targetid="password"></i>
                            </span>
                        </div>
                    </div>

                    <a class="c-btn c-btn--primary c-btn--fullwidth" style="color: white;" id="login">Login</a>

                </div>
            </div>

            <!--<div class="o-line">
                <a class="u-text-mute u-text-small" href="lupa-password.html">Lupa Password</a>
            </div>-->
        </div>