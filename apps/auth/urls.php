<?php 
	return array(
		url('/account', 'main', 'alias_account'),
		url('/login', 'login', 'alias_login'),
		url('/logout', 'logout', 'alias_logout'),
		url('/account/{id}-{login}', 'main', 'alias_prof'),
		url('/account/edit', 'edit', 'alias_edit'),
		url('/register', 'register', 'alias_register')
		);
 ?>

