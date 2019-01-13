<?php


class Blog_Controller extends Controller
{
	public function Main($args){
		//lorem(30);
		$per_page = PER_PAGE;
		$page_count = page_count('blog',PER_PAGE); 
		$offset = page_offset($per_page);
		$collection = db_collection('blog',$offset,$per_page);
		while( $art = $collection->next() ) {
			$cat = db_find('categories','id',array($art['category_id']),1);
			$art['cat'] = $cat['name'];
			$news_list[]=$art;
		}
		if(isset($news_list)){
		foreach ($news_list as $art) {
			$art['name'] = str2url($art['title']);
			
		}
		render('main', array(
			'title' =>  'Новости',
			'blog' => 'active',
			'news' => $news_list,
			'url'=>$args,
			'page_count' => $page_count

		));
	}
	}

	public function read($args){
		$article = db_find('blog', 'id', array($args['1']),1);
		$views = $article['views'];
		db_exec("UPDATE `blog` SET `views` = ? WHERE `id` = ?",array($views+1,$article['id']));
		render('page', array(
			'today' => today(),
			'article' => $article,
			'title' =>  'Новости'
		));
	}

	public function category($args){
		$cat = db_find('categories','id',array($args['1']),1);
		
		$per_page = PER_PAGE; 
		$page_count = page_count('blog',$per_page,1,$args['1']); 
		$offset = page_offset($per_page);
		$collection = db_collection('blog',$offset,$per_page,1,$cat['id']);
		while( $art = $collection->next() ) {
			$news_list[]=$art;
		}
		if(isset($news_list)){
		foreach ($news_list as $art) {
			$art['name'] = str2url($art['title']);
		}
		render('main', array(
			'title' =>  'Записи &laquo;'.$cat['name'].'&raquo;',
			'view' => 'cat',
			'news' => $news_list,
			'page_count' => $page_count
		));
	}
	}
}
?>