<a href="/pages/index.html">

<script src="/pages/javascript/accs.js" type="text/javascript"></script>
<script src="/pages/javascript/initials.js" type="text/javascript"></script>

    <div style="margin:40 12%;" class="btn"><p id="button_home" class="btn_text" align="center"></p></div>
    </a>
    <a href="/pages/members.php">
    <div style="margin:40 32%;" class="btn"><p id="button_members" class="btn_text" align="center"></p></div>
    </a>
    <a href="/pages/news.php">
    <div style="margin:40 52%;" class="btn"><p id="button_news" class="btn_text" align="center"></p></div>
    </a>
    
    
    <div id="button_myCab_bg" style="margin:40 72%;" onclick="accountTip();" class="btn">

        <p id="button_myCab" class="btn_text" align="center"></p>
        <div class="acc_menu" style="visibility:hidden; background: black; opacity:0.4;  width:100%; height:100; position:absolute; margin:40 0;"></div>
        <a class="acc_menu" style="visibility:hidden; font-family:HeaderText; text-align:center; color: white; opacity:1;  width:100%; height:100; position:absolute; margin:40 0;">в целях достоверности ваших данных авторизация возможна только при помощи фейсбука</a>
        
        <div class="acc_menu" style="visibility:hidden; background:#4267b2; opacity:1;  width:100%; height:20; position:absolute; margin:140 0;">
        
        <div id="fb_button" class="fb-login-button" data-width="100%" style="display:none;" onclick="chekFB();" data-max-rows="1" data-size="small" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="true"></div>                         
        <a id="logout_button" onclick="logOut();" style="display:none; visibility:visible; font-family:HeaderText; text-align:center; color: white; opacity:1;  width:100%; height:100; position:absolute; margin:auto auto;">выход</a>                
        
        <div  onclick="fbLogin();" style="width:100%;height:20; position:absolute; top:0;"></div>

        </div>
    </div>

    <div style="padding:auto; margin:30 0;" id="shapka_fon">
    <b class="head" style="margin:0 60;">IT B.E.A.N.S.</b>
    </div>

    
    <div style="position:absolute; background: red; width:100; top:60; right:50; transform:rotate(-45deg); height:25;">
        <a style="position:absolute; text-align:center; margin:2 25%; color:white; font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif">
            ALPHA
            </a>
        </div>
    
        <div style="width:100; height:100; position:absolute; top:0; margin:20 -75; background:#225dae; transform:rotate(45deg);"></div>
        
    <a style="opacity:0.5; position:fixed; bottom:10; right:10; font-size:15; font-family:HeaderText;">
        IT B.E.A.N.S. oficial site alpha v.0.8.0
    </a>

    <?php include('php/registration.php'); ?>
    <?php
    chekUserRegistration();
    ?>