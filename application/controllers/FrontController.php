<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FrontController extends CI_Controller {

	static $data = array();

	public function index(){
		$page_id = strip_tags(trim($this->security->xss_clean($this->input->get('sayfa'))));
		if(empty($page_id) || is_null($page_id)){
			$page_id = 0;
		}

		$data['pages'] = $this->FrontModel->getPages();
		
		$data['footerRandomBooks'] = $this->FrontModel->footerRandomBooks();
		$data['footerPopularBooks'] = $this->FrontModel->footerPopularBooks();
		$data['randomBookBottom'] = $this->FrontModel->getRandomBookBottom();
		$data['getCategories'] = $this->FrontModel->getCategories();
		$data['settings'] = $this->FrontModel->getSettings();

		$this->load->library('pagination');

		$config['base_url'] = base_url();
		$config['total_rows'] = $this->FrontModel->bookCount();
		$config['per_page'] = 20;
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'sayfa';
		$config['cur_tag_open'] = '<li class="current"><a href="">';
		$config['cur_tag_close'] = '</a></li>';
		$data['feedBooks'] = $this->FrontModel->getFeedBooks($config['per_page'], $page_id);
		$this->pagination->initialize($config);

		$data['pagination'] = $this->pagination->create_links();


		$this->load->view('index', $data);
	}

	public function single($slug){
		$slug = strip_tags(trim(str_replace('[removed]', '', $this->security->xss_clean($slug))));
		if($this->FrontModel->getSingle($slug)->num_rows()){
			$data['single'] = $this->FrontModel->getSingle($slug)->result()[0];
			$data['footerRandomBooks'] = $this->FrontModel->footerRandomBooks();
			$data['footerPopularBooks'] = $this->FrontModel->footerPopularBooks();
			$data['randomBookBottom'] = $this->FrontModel->getRandomBookBottom()[0];
			$data['settings'] = $this->FrontModel->getSettings();
			$data['pages'] = $this->FrontModel->getPages();
			$data['getCategories'] = $this->FrontModel->getCategories();

			$this->FrontModel->viewCount($this->FrontModel->getBookIDBySlug($slug));
			$this->load->view('single', $data);
		}else if($this->FrontModel->getSingle($slug)->num_rows() != 1){
			$this->notFound();
		}
	}

	public function page($slug){
		$slug = strip_tags(trim(str_replace('[removed]', '', $this->security->xss_clean($slug))));
		if($this->FrontModel->getPage($slug)->num_rows() == 1){
			$data['page'] = $this->FrontModel->getPage($slug)->result();
			$data['footerRandomBooks'] = $this->FrontModel->footerRandomBooks();
			$data['footerPopularBooks'] = $this->FrontModel->footerPopularBooks();
			$data['settings'] = $this->FrontModel->getSettings();
			$data['pages'] = $this->FrontModel->getPages();
			$data['getCategories'] = $this->FrontModel->getCategories();
			$this->load->view('page', $data);
		}else{
			$this->notFound();
		}
		
	}

	public function category($slug){
		$slug = clearTerm(trim(strip_tags($this->security->xss_clean($slug))));

		if($this->FrontModel->getCategory($slug)->num_rows() == 1 && $this->FrontModel->catPostsCount($slug) !=0){

			$page_id = clearTerm(strip_tags(trim($this->security->xss_clean($this->input->get('sayfa')))));
			$data['footerRandomBooks'] = $this->FrontModel->footerRandomBooks();
			$data['footerPopularBooks'] = $this->FrontModel->footerPopularBooks();
			$data['randomBookBottom'] = $this->FrontModel->getRandomBookBottom()[0];
			$data['settings'] = $this->FrontModel->getSettings();
			$data['pages'] = $this->FrontModel->getPages();
			$data['getCategories'] = $this->FrontModel->getCategories();


			$this->load->library('pagination');

			$config['base_url'] = base_url('kategori/' . $slug . '/');
			$config['total_rows'] = $this->FrontModel->catPostsCount($slug);
			$config['per_page'] = 3;
			$config['page_query_string'] = TRUE;
			$config['use_page_numbers'] = TRUE;
			$config['query_string_segment'] = 'sayfa';
			$config['cur_tag_open'] = '<li class="current"><a href="">';
			$config['cur_tag_close'] = '</a></li>';
			$data['catPosts'] = $this->FrontModel->getCategoryPosts($slug, $config['per_page'], $page_id);
			$this->pagination->initialize($config);

			$data['pagination'] = $this->pagination->create_links();

			$this->load->view('category', $data);
		}else{
			$this->notFound();
		}
	}

	public function author($author_slug){
		$author_slug = strip_tags(trim($this->security->xss_clean($author_slug)));
		$page_num = strip_tags(trim($this->security->xss_clean($this->input->get('sayfa'))));
		if($this->FrontModel->getAuthor($author_slug)->num_rows()){
			$data['footerRandomBooks'] = $this->FrontModel->footerRandomBooks();
			$data['footerPopularBooks'] = $this->FrontModel->footerPopularBooks();
			$data['randomBookBottom'] = $this->FrontModel->getRandomBookBottom()[0];
			$data['settings'] = $this->FrontModel->getSettings();
			$data['pages'] = $this->FrontModel->getPages();
			$data['getCategories'] = $this->FrontModel->getCategories();

			$this->load->library('pagination');

			$config['base_url'] = base_url('yazar/' . $author_slug . '/');
			$config['total_rows'] = $this->FrontModel->getAuthorBookCount($author_slug);
			$config['per_page'] = 2;
			$config['page_query_string'] = TRUE;
			$config['use_page_numbers'] = TRUE;
			$config['query_string_segment'] = 'sayfa';
			$config['cur_tag_open'] = '<li class="current"><a href="">';
			$config['cur_tag_close'] = '</a></li>';

			$data['catPosts'] = $this->FrontModel->authorBooks($author_slug, $config['per_page'], $page_num);

			$this->pagination->initialize($config);

			$data['pagination'] = $this->pagination->create_links();
			$this->load->view('author', $data);
		}else{
			$this->notFound();
		}
		
	}
	//random book page
	public function randomBook(){
		$this->single($this->FrontModel->getRandomBook()[0]->book_slug);
	}


	public function sitemap(){
		$posts = $this->FrontModel->bookSlugs();
		$pages  = $this->FrontModel->pageSlug();
		$categories  = $this->FrontModel->catSlug();
		header("Content-type: text/xml");
		echo '<?xml version="1.0" encoding="UTF-8"?>
		<urlset xmlns="http://www.google.com/schemas/sitemap/0.84"
		xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
		xsi:schemaLocation="http://www.google.com/schemas/sitemap/0.84 http://www.google.com/schemas/sitemap/0.84/sitemap.xsd">' . PHP_EOL;
		echo '
		<url>
		<loc>'.base_url().'</loc>
		<changefreq>hourly</changefreq>
		<priority>1.0</priority>
		</url>' . PHP_EOL; 

		foreach($posts as $book){
			echo '
			<url>
			<loc>'.base_url('kitap/') . $book->book_slug.'</loc>
			<changefreq>weekly</changefreq>
			<priority>0.5</priority>
			</url>' . PHP_EOL;
		}

		foreach($pages as $page){
			echo '
			<url>
			<loc>'.base_url('sayfa/') . $page->page_slug.'</loc>
			<changefreq>weekly</changefreq>
			<priority>0.5</priority>
			</url>' . PHP_EOL;
		}


		foreach($categories as $cat){
			echo '
			<url>
			<loc>'.base_url('kategori/') . $cat->cat_slug.'</loc>
			<changefreq>daily</changefreq>
			<priority>0.5</priority>
			</url>' . PHP_EOL;
		}
		echo '</urlset>' . PHP_EOL;

	}

	public function notFound(){
		$this->session->set_flashdata('notification', "swal('Sayfa Bulunamadı!', 'Aradığınız sayfa bulunamadı, Anasayfaya yönlendirildiniz!', 'success')");
		redirect(base_url());
	}
}
