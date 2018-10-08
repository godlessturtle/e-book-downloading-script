<?php 

class FrontModel extends CI_Model{

	//header
	public function getCategories(){
		$query  = $this->db->get('categories');
		return $query->result();
	}

	public function getFeedBooks($count, $segment){
		$query = $this->db->order_by('book_id', 'DESC')->limit($count, $segment)->get('books');
        return $query->result();
	}

	public function bookCount(){
		$query = $this->db->get('books');
		return $query->num_rows();
	}

	public function getSingle($slug){
		$query = $this->db->get_where('books', array('book_slug' => $slug));
		$book_id = $query->result()[0]->book_id;
		return $query;
	}

	public function getBookIDBySlug($slug){
		$query = $this->db->get_where('books', array('book_slug' => $slug));
		$book_id = $query->result()[0]->book_id;
		return $book_id;
	}

	public function viewCount($book_id)
    {
        $this->db->where('book_id', $book_id, trim(urldecode($book_id)));
        $this->db->select('book_views');
        $count = $this->db->get('books')->row();

        $this->db->where('book_id', $book_id, urldecode($book_id));
        $this->db->set('book_views', ($count->book_views + 1));
        $this->db->update('books');

        return $this->db->select('book_views')->get_where('books', array('book_id' => $book_id))->result();
    }


    public function getRandomBook(){
    	$query = $this->db->select('book_slug')->limit(1)->order_by('rand()')->get('books');
    	return $query->result();
    }

    public function getRandomBookBottom(){
    	$query = $this->db->limit(1)->order_by('rand()')->get('books');
    	return $query->result();
    }


	public function footerRandomBooks($count = 5){
		$query = $this->db->order_by('rand()')->limit($count)->get('books');
		return $query->result();
	}

	public function footerRecentBooks($count = 5){
		
	}

	public function footerPopularBooks($count = 5){
		$query = $this->db->order_by('book_views', 'DESC')->limit($count)->get('books');
		return $query->result();
	}










	public function getCategory($cat_slug){
		$query = $this->db->get_where('categories', array('cat_slug' => $cat_slug));
		return $query;
	}

	public function getCategoryPosts($cat_slug, $count, $segment){
		$query = $this->db->order_by('book_id', 'DESC')->limit($count, $segment)->get_where('books', array('book_category' => $cat_slug));
        return $query->result();
	}

	public function catPostsCount($slug){
		$query = $this->db->get_where('books', array('book_category' => $slug));
		return $query->num_rows();
	}









	public function getPage($slug){
		$query = $this->db->get_where('pages', array('page_slug' => $slug));
		return $query;
	}

	public function getPages(){
		return $this->db->get('pages')->result();
	}






	public function getSettings(){
		return $this->db->get('settings')->result();
	}





	public function authorBooks($author_slug, $limit, $segment){
		return $this->db->limit($limit, $segment)->get_where('books', array('book_author' => $author_slug))->result();
	}

	public function getAuthorBookCount($author_slug){
		return $this->db->get_where('books', array('book_author' => $author_slug))->num_rows();
	}

	public function getAuthor($slug){
		return $this->db->select('author_slug')->get_where('authors', array('author_slug' => $slug));
	}





	//sitemap funcs
	public function bookSlugs(){
		$query = $this->db->select('book_slug')->get('books');
		return $query->result();
	}

	public function pageSlug(){
		$query = $this->db->select('page_slug')->get('pages');
		return $query->result();
	}

	public function catSlug(){
		$query = $this->db->select('cat_slug')->get('categories');
		return $query->result();
	}


}

 ?>