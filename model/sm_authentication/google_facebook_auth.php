<?php

require_once 'google_auth.php';
require_once 'facebook_auth.php';

$permissions        = ['email'];
$redirect_url       = base_url . 'model/sm_authentication/facebook_callback';
$facebook_login_url = $helper->getLoginUrl($redirect_url, $permissions);

$google_login_url   = $google_client->createAuthUrl();

function google_url() { 
    global $google_login_url;
?>
    <div class="form-group">
    	<div class="input-icons" style="background: #db3236;border-radius: 10px;border: solid;border-color: #db3236;color: white;">
    		<i class="fab fa-google icon"></i>
    		<button class="input-field" style="border: none;background: #db3236;border-radius: 10%;color: white;font-weight: bold;" type="button" onClick="window.location = '<?= $google_login_url ?>';">
    		        Log In With Google
    		</button>
    	</div>
    </div>
<?php
}

function facebook_url() { 
    global $facebook_login_url;
?>
    <div class="form-group">
    	<div class="input-icons" style="background: #3b5998 ;border-radius: 10px;border: solid;border-color: #3b5998 ;color: white;">
    		<i class="fab fa-facebook icon"></i>
    		<button class="input-field" style="border: none;background: #3b5998 ;border-radius: 10%;color: white;font-weight: bold;" type="button" onClick="window.location = '<?= $facebook_login_url ?>';">
    		        Log In With Facebook
    		</button>
    	</div>
    </div>
<?php
}