<!-- Footer -->
<div id="footer-wrapper">
	<footer id="footer" class="container">
		<div class="row">
			<div class="col-4 col-6-medium col-12-small">

				<!-- Links -->
				<section class="widget links">
					<h3>Popüler Kitaplar</h3>
					<ul class="style2">
						<?php foreach($footerPopularBooks as $pop){ ?>
							<li><a href="<?php echo base_url('kitap/' . $pop->book_slug); ?>"><?php echo html_escape($pop->book_title); ?></a></li>
						<?php } ?>
					</ul>
				</section>

			</div>
			<div class="col-4 col-6-medium col-12-small">
				<section class="widget links">
					<h3>Rastgele Kitaplar</h3>
					<ul class="style2">
						<?php foreach($footerRandomBooks as $random){ ?>
							<li><a href="<?php echo base_url('kitap/') . $random->book_slug; ?>"><?php echo html_escape($random->book_title); ?></a></li>
						<?php } ?>
					</ul>
				</section>

			</div>
			<div class="col-3 col-6-medium col-12-small">
				<section class="widget contact last">
					<h3>İletişim</h3>
					<ul>
						<?php
						if(is_null($settings[0]->set_facebook) || empty($settings[0]->set_facebook)){ 

							echo ""; }else{echo '<li><a href="'.$settings[0]->set_facebook.'" class="icon fa-facebook"><span class="label">Facebook</span></a></li>';}

							if(is_null($settings[0]->set_twitter) || empty($settings[0]->set_twitter)){ 

								echo ""; }else{echo '<li><a href="'.$settings[0]->set_twitter.'" class="icon fa-twitter"><span class="label">Twitter</span></a></li>';}

								if(is_null($settings[0]->set_instagram) || empty($settings[0]->set_instagram)){ 

									echo ""; }else{echo '<li><a href="'.$settings[0]->set_instagram.'" class="icon fa-instagram"><span class="label">Instagram</span></a></li>';}

									if(is_null($settings[0]->set_pinterest) || empty($settings[0]->set_pinterest)){ 

										echo ""; }else{echo '<li><a href="'.$settings[0]->set_pinterest.'" class="icon fa-pinterest"><span class="label">Pinterest</span></a></li>';}

										if(
											(is_null($settings[0]->set_facebook) || empty($settings[0]->set_facebook)) &&
											(is_null($settings[0]->set_twitter) || empty($settings[0]->set_twitter)) &&
											(is_null($settings[0]->set_instagram) || empty($settings[0]->set_instagram)) &&
											(is_null($settings[0]->set_pinterest) || empty($settings[0]->set_pinterest))
										)
										{



											echo " Bilgi Yok";

										}



										?>
									</ul>
								</section>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<div id="copyright">
									<ul class="menu">
										<li><a href="<?php echo base_url(); ?>"><?php echo $settings[0]->set_logo_text; ?></a> | Tüm hakları saklıdır 2018</li>
									</ul>
								</div>
							</div>
						</div>
					</footer>
				</div>
			</div>			
			<script src="<?php echo base_url(); ?>/assets/js/jquery.min.js"></script>
			<script src="<?php echo base_url(); ?>/assets/js/jquery.dropotron.min.js"></script>
			<script src="<?php echo base_url(); ?>/assets/js/browser.min.js"></script>
			<script src="<?php echo base_url(); ?>/assets/js/breakpoints.min.js"></script>
			<script src="<?php echo base_url(); ?>/assets/js/util.js"></script>
			<script src="<?php echo base_url(); ?>/assets/js/main.js"></script>
			<script src="<?php echo base_url('/assets/vendor/sweetalert/dist/sweetalert.min.js'); ?>"></script>
			<script type="text/javascript">
			<?php if($this->session->flashdata('notification')) { echo $this->session->flashdata('notification'); } ?>
			</script>