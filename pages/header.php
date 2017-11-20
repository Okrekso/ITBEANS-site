    <script src="/pages/javascript/accs.js" type="text/javascript"></script>
    <script src="/pages/javascript/initials.js" type="text/javascript"></script>

    <a href="/pages/index.html">
    <?php include_once 'php/registration.php'?>

    <div style="margin:40 12%;" class="btn"><p id="button_home" class="btn_text" align="center"></p></div>
    </a>
    
    <a href="/pages/members.php">
    <div style="margin:40 32%;" class="btn"><p id="button_members" class="btn_text" align="center"></p></div>
    </a>

    <div style="margin:40 52%;" id="button_news_bg" onmouseenter="newsTip();" class="btn">
        <p id="button_news" class="btn_text" align="center"></p>
        <div onmousedown="gotoNews();" style="position:absolute; top:0; width:100%;height:100%;"></div>
        <?php
        if(getUserProtectLevel()>1)
        {
        echo "<div id=\"button_news_window\" class=\"news_menu\" style=\"visibility:hidden; background-color:rgba(0,0,0,0.99); width:100%; height:20; position:absolute; margin:40 0;\">";
        echo "</div>";
        echo "<div style=\"width:100%;\" onmousedown=\"gotoNewPost();\" class=\"news_menu menu_element\">";
            echo "<a class=\"text_S\" style=\"position:absolute; width:100%; text-align:center; margin:0 auto; color:white;\">новий пост</a>";
        echo "</div>";
        }
        ?>
    </div>
    
    <script type="text/javascript" src="/pages/javascript/jquery.cookie.js"></script>
    <div id="button_myCab_bg" onmouseenter="accountTip();" style="margin:40 72%;" class="btn">
    
        <p id="button_myCab" class="btn_text" align="center"></p>
        <div id="button_myCab_clicker" style="position:absolute; top:0; width:100%;height:100%;"></div>
        
        <div id="button_myCab_window" class="acc_menu" style="visibility:hidden; background: black; background-color:rgba(0,0,0,0.99);  width:100%; height:100; position:absolute; margin:40 0;"></div>
        <a class="acc_menu" style="visibility:hidden; font-family:HeaderText; text-align:center; color: white; opacity:1;  width:100%; height:80; position:absolute; margin:40 0;">з метою достовірності введених даних авторізація доступна лише за допомогою фейсбука</a>
        

        <div class="acc_menu" style="visibility:hidden; background:#4267b2; opacity:1;  width:100%; height:20; position:absolute; margin:140 0;">
        
        
        <?php 
        if(getUserProtectLevel()>1)
        {
        echo "<div class=\"acc_menu\" style=\"visibility:hidden; background:#304e8d; opacity:1;  width:100%; height:20; position:absolute; margin:20 0;\">";
            echo "<a id=\"myEvents_button\" class=\"logout_text acc_menu\">мої події</a>";
            echo "<div onclick=\"gotoMyEvents();\" style=\" width:100%; height:20; position:absolute; top:0\"></div>";    
        echo "</div>";
        }
        else {echo "<a id=\"myEvents_button\"></a>";}
        ?>

        <div id="fb_button" class="fb-login-button" data-width="100%" style="display:none;" onclick="chekFB();" data-max-rows="1" data-size="small" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="true"></div>                         
        <a id="logout_button" class="logout_text acc_menu">вихід</a>                
        
        <div  onclick="fbLogin();" style="width:100%;height:20; position:absolute; top:0;"></div>

        </div>
    </div>

    <div style="padding:auto; margin:30 0;" id="shapka_fon">
    <b class="head" style="margin:0 60;">IT B.E.A.N.S.</b>
    </div>

    
    <div style="position:absolute; background: red; width:100; top:60; right:50; transform:rotate(-45deg); height:25;">
        <a style="position:absolute; text-align:center; margin:2 25%; color:white; font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif">
            BETA
            </a>
        </div>
    
        <div style="width:100; height:100; position:absolute; top:0; margin:20 -75; background:#225dae; transform:rotate(45deg);"></div>
        
    <a style="opacity:0.5; position:fixed; bottom:10; right:10; font-size:15; font-family:HeaderText;">
        IT B.E.A.N.S. oficial site beta v.0.1.3
    </a>

    <?php
    chekUserRegistration();
    ?>