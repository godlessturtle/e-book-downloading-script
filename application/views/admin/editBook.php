<!doctype html>
<html lang="tr">
<head>
	<title>Kitabı Düzenle - Yönetim Paneli</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<?php $this->load->view('admin/includes/header'); ?>
	<?php $this->load->view('admin/includes/sidebar'); ?>
	<div class="main">
		<div class="main-content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<!-- TABLE STRIPED -->
						<div class="panel">
							<div class="panel-heading">
								<h2 style="float: left;;" class="panel-title">Kitap ekle</h2>
							</div>
							<div class="panel-body">
								<form action="<?php echo base_url('panel/kitap/guncelle'); ?>" method="POST" enctype="multipart/form-data">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
									<input type="hidden" name="book_id" value="<?php echo $this->uri->segment(4); ?>">
									<div class="form-group col-md-6">
										<label for="baslik"> Kitap Başlığı</label>
										<input required="required" type="text" value="<?php echo $single->book_title; ?>" name="book_title" class="form-control">
									</div>
									<div class="form-group col-md-6">
										<label for="cats">Yazar</label>
										<select name="book_author" class="form-control">
										
											<?php foreach($authors as $aut){ ?>
												<?php if($single->book_author == $aut->author_slug){ 
													?>
													<option selected="selected" id="<?php echo $aut->author_id; ?>" value="<?php echo $aut->author_slug; ?>"><?php echo $aut->author_name; ?></option>
												<?php } else { ?>


													<option  id="<?php echo $aut->author_id; ?>" value="<?php echo $aut->author_slug; ?>"><?php echo $aut->author_name; ?></option>
												<?php } } ?>
											</select>
										</div>
										<div class="form-group col-md-12">
											<label for="editor1">Kitap Detayı</label>
											<textarea required="required" name="editor1" id="editor1" rows="10" cols="80">
												<?php echo trim($single->book_text); ?>
											</textarea>
										</div>
										<div class="form-group col-md-4">
											<label for="cats">Kategori</label>
											<select name="book_category" class="form-control">
												<?php foreach($categories as $cat){ ?>
													<?php if($cat->cat_slug == $single->book_category){ ?>
														<option selected="selected" id="<?php echo $cat->cat_id; ?>" value="<?php echo $cat->cat_slug; ?>"><?php echo $cat->cat_name; ?></option>

													<?php } else { ?>
													<option id="<?php echo $cat->cat_id; ?>" value="<?php echo $cat->cat_slug; ?>"><?php echo $cat->cat_name; ?></option>

												<?php } } ?>
											</select>
										</div>
										<div class="form-group col-md-4">
											<label for="baslik"> İndirme Linki</label>
											<input type="text" required="required" value="<?php echo $single->book_dl_link; ?>" name="book_dl_link" class="form-control">
										</div>
										<div class="form-group col-md-4">
											<label for="baslik"> Kitap Kapağı</label>
											<input type="file"  name="book_photo" class="form-control">
										</div>
										<div class="form-group col-md-12">
											<label for="currentImg">Güncel Kapak Resmi</label><br>
										<img width="100" name="currentImg" height="150" style="object-fit: cover;" src="<?php echo base_url($single->book_cover); ?>">
										
										</div>
										<div class="form-group col-md-12">
											<input class="btn btn-success" value="Güncelle" type="submit">
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<?php $this->load->view('admin/includes/footer'); ?>
		<script src="<?php echo base_url('assets/admin-assets/vendor/ckeditor/ckeditor.js');  ?>" ></script>
		<script>
			CKEDITOR.replace( 'editor1' );
		</script>
	</body>

	</html>