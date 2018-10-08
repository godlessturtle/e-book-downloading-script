<!doctype html>
<html lang="tr">
<head>
	<title>Kategoriler - Yönetim Paneli</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<?php $this->load->view('admin/includes/header'); ?>
	<!-- LEFT SIDEBAR -->
	<?php $this->load->view('admin/includes/sidebar'); ?>
	<!-- END LEFT SIDEBAR -->
	<!-- MAIN -->
	<!-- Button trigger modal -->


	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="exampleModalLabel">Yeni Kategori Oluştur</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?php echo base_url('panel/kategori/ekle'); ?>" method="POST">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
						<div class="form-group">
							<label for="cat_name">Kategori Adı</label>
							<input required="required" class="form-control" type="text" name="cat_name">
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">İptal</button>
						<input type="submit" class="btn btn-success"/>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="main">
		<!-- MAIN CONTENT -->
		<div class="main-content">
			<div class="container-fluid">
				
				<div class="row">


					<div class="col-md-12">
						<!-- TABLE STRIPED -->
						<div class="panel">
							<div class="panel-heading">
								<h3 style="float: left;;" class="panel-title">Kategoriler</h3>
								<br><small>Silinen kategoriler ile beraberinde bulunan içerikler de silinecektir.</small>
								<button style="float: left;    background-color: #41B314!important;    padding: 5px 14px!important;" data-toggle="modal" data-target="#exampleModal" class="btn btn-success btn-xs pull-right">Yeni Kategori Ekle</button>
								<?php if($this->session->flashdata('a_deleted')){ echo $this->session->flashdata('a_deleted'); } ?>
							</div>
							<div class="panel-body">
								<table class="table table-striped">
									<thead>
										<tr>
											<th>#ID</th>
											<th>Kategori</th>
											<th>İçerik Sayısı</th>
											<th>İşlem</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($categories as $cat){ ?>
											<tr>
												<td>#<?php echo $cat->cat_id; ?></td>
												<td><?php echo $cat->cat_name; ?></td>
												<td><?php echo getCategoryPostCount($cat->cat_slug); ?></td>
												<td>

													<a style="padding: 2px 4px;" href="<?php echo base_url('panel/kategori/sil/' . $cat->cat_id); ?>" class="btn btn-danger btn-xs">Sil</a>
												</td>
											</tr>
										<?php } ?>
									</tbody>
									
								</table>
								<nav>
									<ul class="pagination">
										<?php echo $pagination; ?>
									</ul>
								</nav>
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

</body>

</html>