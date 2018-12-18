<?php


class Blog_Controller extends Controller
{
	public function Main($args){
		$news_list = db_find('blog');
		foreach ($news_list as $art) {
			$art['name'] = str2url($art['title']);
		}
		render('main', array(
			'title' =>  'Новости',
			'news' => $news_list
		));
	}

	public function read($args){
		$article = db_find('blog', 'id', array($args['1']),1);

		render('page', array(
			'today' => today(),
			'article' => $article,
			'title' =>  'Новости'
		));
}
}
?>