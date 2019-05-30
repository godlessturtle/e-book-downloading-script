<?php 


class AdminController extends CI_Controller{

	static $data = array();

	public function isAdminLoggedIn(){
		if(!$this->session->userdata('adminData')){
			redirect(base_url('login'));
		}
	}

	public function loginPage(){
		$this->load->view('admin/login');
	}

	public function signIn(){
		$email = $this->security->xss_clean($this->input->post('a_mail'));
		$pass = md5(sha1($this->security->xss_clean($this->input->post('a_pass'))));

		$this->load->model('LoginModel');
		$isUserExists = $this->LoginModel->login($email, $pass)->num_rows();
		if($isUserExists == 1){
			$this->session->set_userdata('adminData', $this->LoginModel->login($email, $pass)->result());
			redirect(base_url('panel'));
		}else{
			$this->session->set_flashdata('l_notification', "swal('Hata!','Giriş başarısız!','error');");
			redirect(base_url('login'));
		}

	}

	public function logout(){
		$this->isAdminLoggedIn();
		$this->session->unset_userdata('adminData');
		redirect(base_url('login'));
	}

	public function index(){
		$this->isAdminLoggedIn();
		$data['bookCount'] = $this->AdminBooksModel->bookCount();
		$data['pageCount'] = $this->AdminBooksModel->pageCount();
		$data['categoryCount'] = $this->AdminBooksModel->categoryCount();
		$data['authorCount'] = $this->AdminBooksModel->authorCount();
		$this->load->view('admin/index', $data);
	}

	public function books(){
		$this->isAdminLoggedIn();
		$page_num = strip_tags(trim($this->security->xss_clean($this->input->get('page'))));
		$this->load->library('pagination');

		$config['base_url'] = base_url('panel/books');
		$config['total_rows'] = $this->AdminBooksModel->bookCount();
		$config['per_page'] = 16;
		$config['page_query_string'] = TRUE;
		$config['use_page_numbers'] = TRUE;
		$config['query_string_segment'] = 'page';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = 'Sonraki';
		$config['last_link'] = 'Son';
		$config['prev_link'] = 'Önceki';
		$config['first_link'] = 'İlk';
		$config['cur_tag_open'] = '<li class="page-item"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$data['books'] = $this->AdminBooksModel->listBooks($config['per_page'], $page_num);
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$this->load->view('admin/books', $data);
	}

	public function deleteBook($id){
		$this->isAdminLoggedIn();
		
		$id = $this->security->xss_clean($id);
		$book_img = $this->AdminBooksModel->getSingleBook($id)->result()[0]->book_cover;
		unlink($book_img);
		$this->AdminBooksModel->deleteBooks($id);

		$this->session->set_flashdata('notification', "swal('Başarılı!','Kitap Silindi!','success');");
		redirect(base_url('panel/books'));
	}

	public function newBookPage(){
		$this->isAdminLoggedIn();
		
		$data['authors'] = $this->AdminBooksModel->listAuthors();
		$data['categories'] = $this->AdminBooksModel->listCategories();
		$this->load->view('admin/createBook', $data);
	}

	public function createNewBook(){
		$this->isAdminLoggedIn();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('book_title', 'Kitap Başlığı', 'trim|is_unique[books.book_title]');
		if($this->form_validation->run()){




			$title = strip_tags($this->input->post('book_title'));

			$author = strip_tags($this->input->post('book_author'));
			$text = trim($this->input->post('editor1'));
			$cat = $this->input->post('book_category');
			$dl_link = $this->input->post('book_dl_link');
			if ($_FILES['book_photo']['size'] != 0){
				$config['upload_path'] = 'images/';
				$config['allowed_types'] = 'jpeg|jpg|png';
				$config['max_size'] = 2048;
				$config['file_name'] = 'kitap-indir-' . rand(15080, 25000) . rand(25000, 32687);
				$config['min_width'] = 50;
				$config['min_height'] = 50;
				$this->load->library('upload');
				$this->upload->initialize($config);

				if ($this->upload->do_upload('book_photo')) {
					$img = $this->upload->data()['file_name'];
					$path = 'images/' . $img;

					$insertData = array(
						'book_title' => $title,
						'book_category' => $cat,
						'book_text' => $text,
						'book_author' => $author,
						'book_dl_link' => $dl_link,
						'book_cover' => $path,
						'book_slug' => seo($title)
					);
					$this->AdminBooksModel->insertPost($insertData);
					$this->session->set_flashdata('notification', "swal('Başarılı!','Kitap Eklendi!','success');");
					redirect(base_url('panel/books'));
				} else {
					echo $this->upload->display_errors();
				}
			}else {
				echo "resim alanı boş";
			}

		}else{
			$this->load->view('admin/books');
		}
	}



	public function editBook($id){
		$this->isAdminLoggedIn();
		
		$id = $this->security->xss_clean($id);
		if($this->AdminBooksModel->getSingleBook($id)->num_rows() == 1){
			
			$data['authors'] = $this->AdminBooksModel->listAuthors();
			$data['categories'] = $this->AdminBooksModel->listCategories();
			$data['single'] = $this->AdminBooksModel->getSingleBook($id)->result()[0];
			$this->load->view('admin/editBook', $data);
		}else{
			$this->notFound();
		}
	}

	public function updateBook(){
		$this->isAdminLoggedIn();
		
		$book_id = trim($this->security->xss_clean($this->input->post('book_id')));

		$this->form_validation->set_rules('book_title', 'Kitap Başlığı', 'trim|required');
		if($this->form_validation->run()){
			$title = strip_tags($this->input->post('book_title'));
			$author = strip_tags($this->input->post('book_author'));
			$text = trim($this->input->post('editor1'));
			$cat = $this->input->post('book_category');
			$dl_link = $this->input->post('book_dl_link');
			if ($_FILES['book_photo']['size'] != 0){
				$config['upload_path'] = 'images/';
				$config['allowed_types'] = 'jpeg|jpg|png';
				$config['max_size'] = 2048;
				$config['file_name'] = 'kitap-indir-' . rand(15080, 25000) . rand(25000, 32687);
				$config['min_width'] = 50;
				$config['min_height'] = 50;
				$this->load->library('upload');
				$this->upload->initialize($config);

				if ($this->upload->do_upload('book_photo')) {
					$img = $this->upload->data()['file_name'];
					$path = 'images/' . $img;

					$insertData = array(
						'book_title' => $title,
						'book_category' => $cat,
						'book_text' => $text,
						'book_author' => $author,
						'book_dl_link' => $dl_link,
						'book_cover' => $path,
						'book_slug' => seo($title)
					);
					$this->AdminBooksModel->updateBook($book_id, $insertData);
					$this->session->set_flashdata('notification', "swal('Başarılı!','Kitap Güncellendi!','success');");
					redirect(base_url('panel/books'));
				} else {
					echo $this->upload->display_errors();
				}
			}else {
				$insertData = array(
					'book_title' => $title,
					'book_category' => $cat,
					'book_text' => $text,
					'book_author' => $author,
					'book_dl_link' => $dl_link,
					'book_slug' => seo($title)
				);
				$this->AdminBooksModel->updateBook($book_id, $insertData);
				$this->session->set_flashdata('notification', "swal('Başarılı!','Kitap Güncellendi!','success');");
				redirect(base_url('panel/books'));
			}
		}else{
			$this->books();
		}

	}




	public function categories(){
		$this->isAdminLoggedIn();
		
		$page_num = strip_tags(trim($this->security->xss_clean($this->input->get('page'))));
		$this->load->library('pagination');

		$config['base_url'] = base_url('panel/categories');
		$config['total_rows'] = $this->AdminBooksModel->categoryCount();
		$config['per_page'] = 12;
		$config['page_query_string'] = TRUE;
		$config['use_page_numbers'] = TRUE;
		$config['query_string_segment'] = 'page';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = 'Sonraki';
		$config['prev_link'] = 'Önceki';
		$config['first_link'] = 'İlk';
		$config['last_link'] = 'Son';
		$config['cur_tag_open'] = '<li class="page-item"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$data['categories'] = $this->AdminBooksModel->listCategories($config['per_page'], $page_num);
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$this->load->view('admin/categories', $data);
	}

	public function createNewCategory(){
		$this->isAdminLoggedIn();
		
		$cat_name = strip_tags(trim($this->input->post('cat_name')));
		if($this->AdminBooksModel->checkCatSlug(seo($cat_name)) == 1){
			$this->session->set_flashdata('notification', "swal('Hata!','Böyle bir kategori zaten var!','error');");
			redirect(base_url('panel/categories'));
		}else if($this->AdminBooksModel->checkCatSlug(seo($cat_name)) != 1){
			$insertData = array(
				'cat_name' => $cat_name,
				'cat_slug' => seo($cat_name)	

			);
			$this->AdminBooksModel->addCategory($insertData);
			$this->session->set_flashdata('notification', "swal('Başarılı!','Kategori Eklendi!','success');");
			redirect(base_url('panel/categories'));
		}
		
	}

	public function deleteCategory($id){
		$this->isAdminLoggedIn();
		
		$cat_id = $this->security->xss_clean(strip_tags(trim($id)));
		print_r($this->AdminBooksModel->deleteCategory($id)); 
		$this->session->set_flashdata('notification', "swal('Başarılı!','Kategori Silindi!','success');");
		redirect(base_url('panel/categories'));
	}


	public function addAuthor(){
		$this->isAdminLoggedIn();
		$author_name = strip_tags(trim($this->input->post('author_name')));
		if($this->AdminBooksModel->checkAuthorSlug(seo($author_name)) == 1){
			$this->session->set_flashdata('notification', "swal('Hata!','Böyle bir yazar zaten var!','error');");
			redirect(base_url('panel/authors'));
		}else if($this->AdminBooksModel->checkAuthorSlug(seo($author_name)) != 1){
			$insertData = array(
				'author_name' => $author_name,
				'author_slug' => seo($author_name)	

			);
			$this->AdminBooksModel->addAuthor($insertData);
			$this->session->set_flashdata('notification', "swal('Başarılı!','Yazar Eklendi!','success');");
			redirect(base_url('panel/authors'));
		}
	}

	public function authors(){
		$this->isAdminLoggedIn();
		
		$page_num = strip_tags(trim($this->security->xss_clean($this->input->get('page'))));
		$this->load->library('pagination');

		$config['base_url'] = base_url('panel/authors');
		$config['total_rows'] = $this->AdminBooksModel->categoryCount();
		$config['per_page'] = 12;
		$config['page_query_string'] = TRUE;
		$config['use_page_numbers'] = TRUE;
		$config['query_string_segment'] = 'page';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = 'Sonraki';
		$config['prev_link'] = 'Önceki';
		$config['first_link'] = 'İlk';
		$config['last_link'] = 'Son';
		$config['cur_tag_open'] = '<li class="page-item"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$data['authors'] = $this->AdminBooksModel->listAuthors($config['per_page'], $page_num);
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$this->load->view('admin/authors', $data);
	}

	public function deleteAuthor($id){
		$this->isAdminLoggedIn();
		
		$cat_id = $this->security->xss_clean(strip_tags(trim($id)));
		$this->AdminBooksModel->deleteAuthor($id);
		$this->session->set_flashdata('notification', "swal('Başarılı!','Yazar Silindi!','success');");
		redirect(base_url('panel/authors'));
	}

	//sayfalar
	public function pages(){
		$this->isAdminLoggedIn();
		$data['pages'] = $this->AdminBooksModel->listPages()->result();
		$this->load->view('admin/pages', $data);
	}

	public function newPage(){
		$this->isAdminLoggedIn();
		$this->load->view('admin/newPage');
	}

	public function createNewPage(){
		$this->isAdminLoggedIn();
		$page_title = trim(strip_tags($this->security->xss_clean($this->input->post('page_title'))));
		$page_text	= trim($this->input->post('editor1'));

		$this->AdminBooksModel->createPage(array('page_title' => $page_title, 'page_text' => $page_text, 'page_slug' => seo($page_title)));
		$this->session->set_flashdata('notification', "swal('Başarılı!','Sayfa Oluşturuldu!','success');");
		redirect(base_url('panel/pages'));
	}

	public function deletePage($id){
		$this->isAdminLoggedIn();
		$this->AdminBooksModel->deletePage($id);
		$this->session->set_flashdata('notification', "swal('Başarılı!','Sayfa Silindi!','success');");
		redirect(base_url('panel/pages'));
	}

	public function editPage($page_id){
		$this->isAdminLoggedIn();
		$page_id = trim(strip_tags($this->security->xss_clean($page_id)));
		$data['page'] = $this->AdminBooksModel->getSinglePage($page_id)[0];
		$this->load->view('admin/editPage', $data);
	}

	public function updatePage(){
		$this->isAdminLoggedIn();
		$page_title = trim(strip_tags($this->security->xss_clean($this->input->post('page_title'))));
		$page_text	= trim($this->input->post('editor1'));
		$page_id = trim($this->input->post('page_id'));

		$updateData = array(
			'page_title' => $page_title, 
			'page_text' => $page_text, 
			'page_slug' => seo($page_title)
		);
		$this->AdminBooksModel->updatePage($page_id, $updateData);
		$this->session->set_flashdata('notification', "swal('Başarılı!','Sayfa Güncellendi!','success');");
		redirect(base_url('panel/pages'));
	}


	public function settings(){
		$this->isAdminLoggedIn();
		$data['settings'] = $this->AdminBooksModel->getSettings();
		$this->load->view('admin/settings',  $data);
	}

	public function updateSettings(){
		$this->isAdminLoggedIn();

		$suffix = strip_tags(trim($this->input->post('set_suffix')));
		$desc = strip_tags(trim($this->input->post('set_desc')));
		$keyw = strip_tags(trim($this->input->post('set_keyw')));
		$analytics = trim($this->input->post('set_analytics'));
		
		$jt_title  = strip_tags(trim($this->input->post('jt_title')));
		$jt_text = strip_tags(trim($this->input->post('jt_text')));
		$hp_text = strip_tags(trim($this->input->post('set_hp_btn_text')));
		$hp_link = trim($this->input->post('set_hp_btn_link'));

		$insertData = array(
			'tab_id' => 0,
			'set_logo_text' => trim($this->input->post('set_logo_text')),
			'set_suffix' => $suffix,
			'set_desc' => $desc,
			'set_keyw' => $keyw,
			'set_analytics' => $analytics,
			'jt_title' => $jt_title,
			'jt_text' => $jt_text,
			'set_hp_btn_text' => $hp_text,
			'set_hp_btn_link' => $hp_link,
			'set_facebook' => trim($this->input->post('set_facebook')),
			'set_twitter' => trim($this->input->post('set_twitter')),
			'set_instagram' => trim($this->input->post('set_instagram')),
			'set_pinterest' => trim($this->input->post('set_pinterest'))
		);

		$this->AdminBooksModel->updateSettings($insertData);
		$this->session->set_flashdata('notification', "swal('Başarılı!','Ayarlar Güncellendi!','success');");
		redirect(base_url('panel/settings'));
	}



	public function changePassPage(){
		$this->isAdminLoggedIn();
		$data['adminMail'] = $this->AdminBooksModel->getUserDetail()[0]->admin_mail;
		$this->load->view('admin/changePass', $data);
	}

	public function updatePass(){
		$this->isAdminLoggedIn();
		$this->form_validation->set_rules('new_pass', 'Yeni Şifre', 'trim|required|matches[re_pass]');
		$this->form_validation->set_rules('re_pass', 'Yeni Şifre', 'trim|required|matches[re_pass]');
		$old = md5(sha1(trim($this->input->post('old_pass'))));
		if($this->form_validation->run()){
			if($this->AdminBooksModel->getUserDetail()[0]->admin_pass == $old){
				$new = md5(sha1(trim($this->input->post('new_pass'))));
				$this->AdminBooksModel->updatePass(array('admin_pass' => $new));
				$this->session->set_flashdata('notification', "swal('Başarılı!','Şifre Güncellendi!','success');");
				redirect(base_url('panel/sifre'));
			}else{
				$this->session->set_flashdata('notification', "swal('Hata!','Şifre Güncellenemedi!','error');");
				redirect(base_url('panel/sifre'));
			}
		}else{
			$this->changePassPage();
		}		
	}


	public function updateMail(){
		$this->isAdminLoggedIn();
		$new = trim($this->input->post('new_mail'));
		$old = trim($this->input->post('old_mail'));

		if($this->AdminBooksModel->getUserDetail()[0]->admin_mail == $old){
			$this->AdminBooksModel->updatePass(array('admin_mail' => $new));
			$this->session->set_flashdata('notification', "swal('Başarılı!','Mail Güncellendi!','success');");
			redirect(base_url('panel/sifre'));
		}else{
			$this->session->set_flashdata('notification', "swal('Hata!','Mail Güncellenemedi!','success');");
			redirect(base_url('panel/sifre'));
		}
	}


	public function notFound(){
		echo "404";
	}





}









?>
