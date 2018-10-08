<!doctype html>
<html lang="en">
<head>
	<title>Yeni Kitap Oluştur - Yönetim Paneli</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<?php $this->load->view('admin/includes/header'); ?>
	<!-- LEFT SIDEBAR -->
	<?php $this->load->view('admin/includes/sidebar'); ?>
	<!-- END LEFT SIDEBAR -->
	<!-- MAIN -->
	<div class="main">
		<!-- MAIN CONTENT -->
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
								<form action="<?php echo base_url('panel/kitap/yeni'); ?>" method="POST" enctype="multipart/form-data">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
									<div class="form-group col-md-6">
										<label for="baslik"> Kitap Başlığı</label>
										<input required="required" type="text" name="book_title" class="form-control">
									</div>

									<div class="form-group col-md-6">
										<label for="cats">Yazar</label>
										<select name="book_author" class="form-control">
											<?php foreach($authors as $aut){ ?>
											<option id="<?php echo $aut->author_id; ?>" value="<?php echo $aut->author_slug; ?>"><?php echo $aut->author_name; ?></option>
										<?php } ?>
										</select>
									</div>

									<div class="form-group col-md-12">
										<label for="editor1">Kitap Detayı</label>
										<textarea required="required" name="editor1" id="editor1" rows="10" cols="80">

										</textarea>
									</div>

									<div class="form-group col-md-4">
										<label for="cats">Kategori</label>
										<select name="book_category" class="form-control">
											<?php foreach($categories as $cat){ ?>
											<option id="<?php echo $cat->cat_id; ?>" value="<?php echo $cat->cat_slug; ?>"><?php echo $cat->cat_name; ?></option>
											<?php } ?>
										</select>
									</div>

									<div class="form-group col-md-4">
										<label for="baslik"> İndirme Linki</label>
										<input type="text" required="required" name="book_dl_link" class="form-control">
									</div>

									<div class="form-group col-md-4">
										<label for="baslik"> Kitap Kapağı</label>
										<input type="file" required="required" name="book_photo" class="form-control">
									</div>

									<input class="btn btn-success" type="submit">

								</form>
							</div>
						</div>
						<!-- END TABLE STRIPED -->
					</div>


				</div>

			</div>
		</div>
		<!-- END MAIN CONTENT -->
	</div>
	<!-- END MAIN -->
	<div class="clearfix"></div>
	<?php $this->load->view('admin/includes/footer'); ?>
	<script src="<?php echo base_url('assets/admin-assets/vendor/ckeditor/ckeditor.js');  ?>" ></script>
	<script>
		CKEDITOR.replace( 'editor1' );
	</script>
</body>

</html>