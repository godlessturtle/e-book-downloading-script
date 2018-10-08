<!doctype html>
<html lang="tr">
<head>
	<title>Ayarlar - Yönetim Paneli</title>
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
								<form action="<?php echo base_url('panel/ayarlar/guncelle'); ?>" method="POST">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

									<div class="form-group col-md-6">
										<label for="baslik"> Site Logosu/Adı</label>
										<input required="required" type="text" name="set_logo_text" value="<?php echo html_escape($settings[0]->set_logo_text); ?>" placeholder="Text logo kullanılıyor." class="form-control">
									</div>

									<div class="form-group col-md-6">
										<label for="baslik"> Site Son Eki</label>
										<input required="required" type="text" name="set_suffix" value="<?php echo html_escape($settings[0]->set_suffix); ?>" placeholder="Tüm sayfalarda bulunan title etiketine eklenecek" class="form-control">
									</div>

									<div class="form-group col-md-6">
										<label for="baslik"> Site Açıklaması(Description)</label>
										<input required="required" type="text" name="set_desc" value="<?php echo html_escape($settings[0]->set_desc); ?>" class="form-control">
									</div>

									<div class="form-group col-md-6">
										<label for="baslik"> Site Anahtar Kelimeleri(Keywords)</label>
										<input required="required" type="text" name="set_keyw" value="<?php echo html_escape($settings[0]->set_keyw); ?>" class="form-control">
									</div>

									<div class="form-group col-md-12">
										<label for="baslik"> Analytics Kodu</label>
										<input type="text" name="set_analytics" value="<?php echo html_escape($settings[0]->set_analytics); ?>" placeholder="<script>...</script>" class="form-control">
									</div>

									<hr>
									<div style="margin-top: 40px;" class="form-group col-md-6">
										<label for="baslik"> Anasayfa JT Başlık</label>
										<input type="text" required="required" name="jt_title" value="<?php echo html_escape($settings[0]->jt_title); ?>" class="form-control">
									</div>

									<div style="margin-top: 40px;" class="form-group col-md-6">
										<label for="baslik"> Anasayfa JT Detay</label>
										<input type="text" required="required" name="jt_text" value="<?php echo html_escape($settings[0]->jt_text); ?>"  class="form-control">
									</div>

									<div class="form-group col-md-6">
										<label for="baslik"> JT Buton Başlığı</label>
										<input type="text" required="required" name="set_hp_btn_text" value="<?php echo html_escape($settings[0]->set_hp_btn_text); ?>"  class="form-control">
									</div>

									<div class="form-group col-md-6">
										<label for="baslik"> JT Anasayfa Buton Linki</label>
										<input type="text" required="required" name="set_hp_btn_link" value="<?php echo html_escape($settings[0]->set_hp_btn_link); ?>"  class="form-control">
									</div>


									

									<div style="margin-top: 40px;" class="form-group col-md-6">
										<label for="baslik"> Facebook</label>
										<input type="text" name="set_facebook" value="<?php echo html_escape($settings[0]->set_facebook); ?>"  class="form-control">
									</div>

									<div style="margin-top: 40px;" class="form-group col-md-6">
										<label for="baslik"> Twitter</label>
										<input type="text" name="set_twitter" value="<?php echo html_escape($settings[0]->set_twitter); ?>"  class="form-control">
									</div>

									<div class="form-group col-md-6">
										<label for="baslik"> Instagram</label>
										<input type="text" name="set_instagram" value="<?php echo html_escape($settings[0]->set_instagram); ?>"  class="form-control">
									</div>

									<div class="form-group col-md-6">
										<label for="baslik"> Pinterest</label>
										<input type="text" name="set_pinterest" value="<?php echo html_escape($settings[0]->set_pinterest); ?>"  class="form-control">
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