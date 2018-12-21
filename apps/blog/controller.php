<?php


class Blog_Controller extends Controller
{
	public function Main($args){
		//lorem(30);
		$per_page = PER_PAGE; 
		$offset = page_offset($per_page);
		$collection = db_collection('blog',$offset,$per_page);
		while( $art = $collection->next() ) {
			$news_list[]=$art;
		}
		if(isset($news_list)){
		foreach ($news_list as $art) {
			$art['name'] = str2url($art['title']);
		}
		render('main', array(
			'title' =>  'Новости',
			'news' => $news_list
		));
	}
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