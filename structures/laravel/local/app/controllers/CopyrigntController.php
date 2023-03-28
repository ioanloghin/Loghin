<?php

class CopyrigntController extends BaseController {
    protected $layout = 'layouts.master';
	
	public function showDevelopment()
	{
		// Initializeaza Obiectul utilizatorului
		$MyUser = new MyUser(2);

		// Send data for user bar menu
		$accounts_assoc = MyUserBar::getAccountsAssoc($MyUser->getAccountId());
		$accounts_types = MyUserBar::getTypesFrom($accounts_assoc);
		View::share('accounts_assoc', $accounts_assoc);
		View::share('accounts_types', $accounts_types);
		
		// Views
    	$this->layout->title = "Pagina de dezvoltare";
		$this->layout->content = View::make('pages.development');
		
	}
}
