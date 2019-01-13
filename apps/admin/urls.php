<?php 
	return array(
		url('/admin', 'main', 'admin_panel'),
		url('/admin/apps', 'apps', 'admin_apps'),
		url('/admin/settings', 'settings', 'admin_settings'),
		url('/admin/users', 'users', 'admin_users'),
		url('/admin/pages', 'pages', 'admin_pages'),
		url('/admin/blog', 'blog', 'admin_blog'),
		url('/admin/blog/edit/{id}', 'edit', 'admin_blogedit'),
		url('/admin/blog/delete/{id}', 'ArtDelete', 'admin_blogdelete'),
		url('/admin/navlink/delete/{id}', 'NavDelete', 'admin_linkdelete'),
		url('/admin/navlink/edit/{id}', 'Navedit', 'admin_linkedit'),
		url('/admin/blog/add', 'add', 'admin_blogadd'),
		url('/admin/addcategory', 'catadd', 'admin_catadd'),	
		);
 ?>