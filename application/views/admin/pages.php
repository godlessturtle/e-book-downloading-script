<!doctype html>
<html lang="en">
<head>
	<title>Sayfalar - Yönetim Paneli</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<?php $this->load->view('admin/includes/header'); ?>
	<!-- LEFT SIDEBAR -->
	<?php $this->load->view('admin/includes/sidebar'); ?>
	<div class="main">
		<!-- MAIN CONTENT -->
		<div class="main-content">
			<div class="container-fluid">
				
				<div class="row">


					<div class="col-md-12">
						<!-- TABLE STRIPED -->
						<div class="panel">
							<div class="panel-heading">
								<h3 style="float: left;;" class="panel-title">Sayfalar</h3>
								<a href="<?php echo base_url('panel/sayfa/yeni'); ?>" style="float: left;    background-color: #41B314!important;    padding: 5px 14px!important;" class="btn btn-success btn-xs pull-right">Yeni Sayfa Oluştur</a>
								<?php if($this->session->flashdata('a_deleted')){ echo $this->session->flashdata('a_deleted'); } ?>
							</div>
							<div class="panel-body">
								<table class="table table-striped">
									<thead>
										<tr>
											<th>#ID</th>
											<th>Başlık</th>
											<th>İşlem</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($pages as $page){ ?>
											<tr>
												<td>#<?php echo $page->page_id; ?></td>
												<td><?php echo $page->page_title; ?></td>
												<td>

													<a style="padding: 2px 4px;" href="<?php echo base_url('panel/sayfa/sil/' . $page->page_id); ?>" class="btn btn-danger btn-xs">Sil</a>
													<a style="padding: 2px 4px;" href="<?php echo base_url('panel/sayfa/duzenle/' . $page->page_id); ?>" class="btn btn-primary btn-xs">Düzenle</a>
												</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
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