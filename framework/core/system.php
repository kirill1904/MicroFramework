<?php 
class System
{	
	public function install(){
		redirect('/install.php');
	}


public function create_DBstruct(){

	db_exec("DROP TABLE `apps`, `navmenu`, `settings`, `users`,`categories`,`blog`;",array());
	db_exec("
	CREATE TABLE `settings` (
	`id` int(11) NOT NULL,
	`per_page` int(11) NOT NULL,
	`search` tinyint(1) NOT NULL,
	`sitename` varchar(25) NOT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;" ,array());

	db_exec("CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `login` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `regdate` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=COMPACT;
",array());

	db_exec("
	CREATE TABLE `apps` (
	`id` int(11) NOT NULL,
	`appname` varchar(20) NOT NULL,
	`name` varchar(25) NOT NULL,
	`state` tinyint(1) NOT NULL DEFAULT '0',
	`system` tinyint(1) NOT NULL DEFAULT '0',
	`aliases` varchar(255) NOT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;" ,array());

	db_exec("CREATE TABLE `navmenu` (
	`id` int(11) NOT NULL,
	`title` varchar(25) NOT NULL,
	`app` varchar(25) NOT NULL,
	`alias` varchar(25) NOT NULL,
	`badge` int(11) DEFAULT '0',
	`cat` int(11) DEFAULT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;",array());
	
	db_exec("CREATE TABLE `categories` (
	`id` int(11) NOT NULL,
	`name` varchar(25) NOT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;",array());
	db_exec("CREATE TABLE `blog` (
	`id` int(11) NOT NULL,
	`title` varchar(32) NOT NULL,
	`image` varchar(255) DEFAULT NULL,
	`desc` varchar(50) NOT NULL,
	`text` text NOT NULL,
	`date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`views` int(5) NOT NULL DEFAULT '0',
	`category_id` int(11) NOT NULL,
	`likes` int(11) NOT NULL DEFAULT '0'
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;",array());
	
	db_exec("
	INSERT INTO `apps` (`id`, `appname`, `name`, `state`, `system`, `aliases`) VALUES
	(1, 'simple_pages', 'Страницы', 1, 1, 'alias_index@Главная,alias_contact@Контакты'),
	(2, 'auth', 'Аутентификация', 1, 1, 'alias_login@Вход,alias_logout@Выход,alias_register@Регистрация'),
	(3, 'blog', 'Блог', 1, 0, 'alias_blog@Блог,alias_blogcat@Категория'),
	(5, 'development', 'В разработке', 1, 1, 'alias_badlink@В разработке'),
	(6, 'admin', 'Админка', 1, 1, ''),
	(8, 'search', 'Поиск', 1, 0, '');" , array());
	db_exec("INSERT INTO `blog` (`id`, `title`, `image`, `desc`, `text`, `date`, `views`, `category_id`, `likes`) VALUES
	(1, 'Тестовая запись', NULL, 'Ваша первая запись', 'Вы можете изменить текст, или удалить эту запись', '2019-01-04 14:18:29', 0, 0, 0);",array());
	db_exec("INSERT INTO `categories` (`id`, `name`) VALUES
	(0, 'Без категории');",array());
	db_exec("INSERT INTO `settings` (`id`, `per_page`, `search`, `sitename`) VALUES
	(1, 12, 1, 'MyFramework');",array());

	db_exec("INSERT INTO `navmenu` (`id`, `title`, `app`, `alias`, `badge`, `cat`) VALUES
	(1, 'Главная', 'simple_pages', 'alias_index', 0, NULL),
	(3, 'Блог', 'blog', 'alias_blog', 1, NULL),
	(4, 'Контакты', 'simple_pages', 'alias_contact', 0, NULL);",array());

	db_exec("ALTER TABLE `apps` ADD PRIMARY KEY(`id`);",array());
	db_exec("ALTER TABLE `settings` ADD PRIMARY KEY(`id`);",array());
	db_exec("ALTER TABLE `blog` ADD PRIMARY KEY(`id`);",array());
	db_exec("ALTER TABLE `categories` ADD PRIMARY KEY(`id`);",array());
	db_exec("ALTER TABLE `navmenu` ADD PRIMARY KEY(`id`);",array());
	db_exec("ALTER TABLE `users` ADD PRIMARY KEY(`id`);",array());
}
	
	public function set_admin($login,$email,$pass){
		db_exec("INSERT INTO `users` (`id`,`login`,`password`,`email`,`type`)  VALUES (?,?,?,?,?)",array(1,$login,$pass,$email,1));
	}

	public function change_database($name,$login,$pass){
			
		$db_name = "<?php return array('name'=>'$name','login'=>'$login','pass'=>'$pass'); ?>";
		$fp = fopen(__DIR__."/database.php", "w");
		fwrite($fp, $db_name);
		fclose($fp);
		


	}


}
?>