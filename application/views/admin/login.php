<!doctype html>
<html lang="tr" class="fullscreen-bg">
<head>
	<title>Giriş Yap - Yönetim Paneli</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin-assets'); ?>/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin-assets'); ?>/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin-assets'); ?>/vendor/linearicons/style.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin-assets'); ?>/css/main.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin-assets'); ?>/vendor/sweetalert/dist/sweetalert.css">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('assets/admin-assets'); ?>/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url('assets/admin-assets'); ?>/img/favicon.png">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
							<div class="header">

								<p class="lead">Devam etmek için giriş yap</p>
							</div>
							<p><?php if($this->session->flashdata('a_notification')){ echo $this->session->flashdata('a_notification'); } ?></p>
							<form class="form-auth-small" method="post" action="<?php echo base_url('signin'); ?>">
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
								<div class="form-group">
									<label for="signin-email" class="control-label sr-only">Email</label>
									<input type="email" name="a_mail" class="form-control" id="signin-email" placeholder="e-Posta">
								</div>
								<div class="form-group">
									<label for="signin-password" class="control-label sr-only">Password</label>
									<input type="password" name="a_pass" class="form-control" id="signin-password" placeholder="Şifre">
								</div>
								<button type="submit" class="btn btn-primary btn-lg btn-block">Giriş</button>
							</form>
						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
						<div class="content text">
							<p>Bu sayfaya yanlışlıkla geldiyseniz anasayfaya dönmeyi deneyebilirsiniz. <br>  <br><a class="btn btn-success" href="<?php echo base_url(); ?>">Anasayfa'ya dön.</a></p>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<script src="<?php echo base_url('assets/admin-assets/'); ?>vendor/sweetalert/dist/sweetalert.min.js"></script>
	<script type="text/javascript">
		<?php if($this->session->flashdata('l_notification')){
			echo $this->session->flashdata('l_notification');
		} ?>
	</script>
</body>
</html>