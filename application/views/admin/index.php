<!doctype html>
<html lang="tr">
<head>
	<title>Genel Bakış - Yönetim Paneli</title>
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
				<!-- OVERVIEW -->
				<div class="panel panel-headline">
					<div class="panel-heading">
						<h3 class="panel-title">Genel Bakış</h3>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-3">
								<div class="metric">
									<span class="icon"><i class="fa fa-book"></i></span>
									<p>
										<span class="number"><?php echo html_escape($bookCount); ?></span>
										<span class="title">Kitap</span>
									</p>
								</div>
							</div>
							<div class="col-md-3">
								<div class="metric">
									<span class="icon"><i class="fa fa-list"></i></span>
									<p>
										<span class="number"><?php echo html_escape($categoryCount); ?></span>
										<span class="title">Kategori</span>
									</p>
								</div>
							</div>
							<div class="col-md-3">
								<div class="metric">
									<span class="icon"><i class="fa fa-user"></i></span>
									<p>
										<span class="number"><?php echo html_escape($authorCount); ?></span>
										<span class="title">Yazar</span>
									</p>
								</div>
							</div>
							<div class="col-md-3">
								<div class="metric">
									<span class="icon"><i class="fa fa-file-text"></i></span>
									<p>
										<span class="number"><?php echo html_escape($pageCount); ?></span>
										<span class="title">Sayfa</span>
									</p>
								</div>
							</div>
						</div>

					</div>
				</div>
				<!-- END OVERVIEW -->


			</div>
		</div>
		<!-- END MAIN CONTENT -->
	</div>
	<!-- END MAIN -->
	<div class="clearfix"></div>
	<?php $this->load->view('admin/includes/footer'); ?>

</body>

</html>
