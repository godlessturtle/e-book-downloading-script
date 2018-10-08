<?php 

class AdminBooksModel extends CI_Model{

	//kitap, yazar ve kategori fonksiyonları

	public function listBooks($limit, $segment){
		$query = $this->db->limit($limit, $segment)->get('books');
		return $query->result();
	}

	public function deleteBooks($id){
		$this->db->delete('books', array('book_id' => $id));
	}

	public function insertPost($data){
		$this->db->insert('books', $data);
	}

	public function getSingleBook($id){
		$query = $this->db->get_where('books', array('book_id' => $id));
		return $query;
	}

	public function updateBook($id, $data){
		$this->db->where('book_id', $id)->update('books', $data);
	}








	//kategori
	public function listCategories($limit, $segment){
		$query = $this->db->limit($limit, $segment)->order_by('cat_name', 'ASC')->get('categories');
		return $query->result();
	}

	public function checkCatSlug($slug){
		$query = $this->db->get_where('categories', array('cat_slug' => $slug));
		return $query->num_rows();
	}

	public function addCategory($data){
		$this->db->insert('categories', $data);
	}

	public function deleteCategory($id){
		$cat_slug =  $this->db->get_where('categories', array('cat_id' => $id))->result()[0]->cat_slug;
		$this->db->delete('categories', array('cat_id' => $id));
		$this->db->delete('books', array('book_category' => $cat_slug));
	}





	//yazar
	public function listAuthors($limit, $segment){
		$query = $this->db->limit($limit, $segment)->order_by('author_name', 'ASC')->get('authors');
		return $query->result();
	}

	public function deleteAuthor($id){
		$author_slug =  $this->db->get_where('authors', array('author_id' => $id))->result()[0]->author_slug;
		$this->db->delete('books', array('book_author' => $author_slug));
		$this->db->delete('authors', array('author_id' => $id));
	}

	public function checkAuthorSlug($slug){
		$query = $this->db->get_where('authors', array('author_slug' => $slug));
		return $query->num_rows();
	}

	public function addAuthor($data){
		$this->db->insert('authors', $data);
	}



	//sayfa
	public function listPages(){
		$query = $this->db->order_by('page_id', 'DESC')->get('pages');
		return $query;
	}

	public function deletePage($id){
		$this->db->delete('pages', array('page_id' => $id));
	}

	public function createPage($data){
		$this->db->insert('pages', $data);
	}

	public function getSinglePage($id){
		$query = $this->db->get_where('pages', array('page_id' => $id));
		return $query->result();
	}

	public function updatePage($id, $data){
		$this->db->where('page_id', $id)->update('pages', $data);
	}





	public function getSettings(){
		return $this->db->get('settings')->result();
	}

	public function updateSettings($data){
		$this->db->where('tab_id', 0)->update('settings', $data);
	}





	//dashboard funcs
	public function bookCount(){
		return $this->db->get('books')->num_rows();
	}

	public function categoryCount(){
		return $this->db->get('categories')->num_rows();
	}

	public function authorCount(){
		return $this->db->get('authors')->num_rows();
	}

	public function pageCount(){
		return $this->db->get('pages')->num_rows();
	}




	public function getUserDetail(){
		$query = $this->db->get('admin');
		return $query->result();
	}

	public function updatePass($data){
		$this->db->where('admin_id', 1)->update('admin', $data);
	}


}








 ?>