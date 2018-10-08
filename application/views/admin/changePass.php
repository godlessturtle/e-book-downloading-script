<!doctype html>
<html lang="tr">
<head>
	<title>Şifreyi Değiştir - Yönetim Paneli</title>
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
								<h2 style="float: left;;" class="panel-title">Ayarlar</h2>
							</div>
							<div class="panel-body">
								<form action="<?php echo base_url('panel/sifre/guncelle'); ?>" method="POST">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

									<div class="form-group col-md-6">
										<label for="old_pass"> Mevcut Şifre</label>
										<input required="required" type="text" name="old_pass" class="form-control">

										<label for="new_pass"> Yeni Şifre</label>
										<input required="required" type="text" name="new_pass" class="form-control">

										<label for="re_pass"> Yeni Şifre Tekrar</label>
										<input required="required" type="text" name="re_pass" class="form-control">
									</div>

									

									


									
									<div class="form-group col-md-12">
										<input class="btn btn-success" value="Kaydet" type="submit">
									</div>
									

								</form>

								<form action="<?php echo base_url('panel/mail/guncelle'); ?>" method="POST">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

									<div class="form-group col-md-6">
										<label for="old_pass"> Mevcut Eposta</label>
										<input required="required" type="text" name="old_mail" value="<?php echo html_escape($adminMail); ?>" class="form-control">

										<label for="new_pass"> Yeni Eposta</label>
										<input required="required" type="text" name="new_mail" class="form-control">
									</div>

									<div class="form-group col-md-12">
										<input class="btn btn-success" value="Kaydet" type="submit">
									</div>
									

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
</body>

</html>