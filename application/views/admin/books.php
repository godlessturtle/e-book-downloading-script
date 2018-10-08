<!doctype html>
<html lang="tr">
<head>
	<title>Kitaplar  - Yönetim Paneli</title>
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
								<h3 style="float: left;;" class="panel-title">Kitaplar</h3>
								<a style="float: left;;" href="<?php echo base_url('panel/books/new'); ?>" class="btn btn-success btn-xs pull-right">Yeni Kitap Ekle</a>
								<?php if($this->session->flashdata('a_deleted')){ echo $this->session->flashdata('a_deleted'); } ?>
								<?php echo validation_errors(); ?>
							</div>
							<div class="panel-body">
								<table class="table table-striped">
									<thead>
										<tr>
											<th>#ID</th>
											<th>Kitap Adı</th>
											<th>Kategori</th>
											<th>İşlem</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($books as $book){ ?>
											<tr>
												<td>#<?php echo $book->book_id; ?></td>
												<td><?php echo $book->book_title; ?></td>
												<td><?php echo $book->book_category; ?></td>
												<td>

													<a style="padding: 1px 3px;" href="<?php echo base_url('panel/kitap/sil/' . $book->book_id); ?>" class="btn btn-danger btn-xs">Sil</a>
													<a style="padding: 1px 3px;" href="<?php echo base_url('panel/kitap/duzenle/' . $book->book_id); ?>" class="btn btn-primary btn-xs">Düzenle</a>
												</td>
											</tr>
										<?php } ?>
									</tbody>
									<nav aria-label="Page navigation example">
										<ul class="pagination">
											<?php echo $pagination; ?>
										</ul>
									</nav>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<?php $this->load->view('admin/includes/footer'); ?>
</body>
</html>