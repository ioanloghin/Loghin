<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autologin extends CI_Controller {

	public function received($rawtoken)
	{
		// Received token from login server
		$token = rawurldecode($rawtoken);
		// Save in SESSION
		$this->session->set_userdata("autologin_token", $token);
	}
	
	public function iframe()
	{
		$login_server_url = 'http://structures.loghin.com/crossdomain/login/';
		$callback_url = 'http://studiosanua.com/autologin/received';
		?>
        <iframe src="<?php echo $login_server_url;?>?ref=<?php echo rawurlencode($callback_url);?>" width="0" height="0" frameborder="0"></iframe>
        <?php
	}

}
