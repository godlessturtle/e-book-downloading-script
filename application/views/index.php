<!DOCTYPE html>
<html lang="tr">
<head>
	<title>Anasayfa <?php echo html_escape($settings[0]->set_suffix); ?></title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<meta name="description" content="<?php echo $settings[0]->set_desc; ?>">
	<meta name="keywords" content="<?php echo $settings[0]->set_keyw; ?>">
	<link rel="stylesheet" href="<?php base_url(); ?>assets/css/main.css?ver=87" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/vendor/sweetalert/dist/sweetalert.css'); ?>">
</head>
<body class="is-preload homepage">
	<div id="page-wrapper">

		<!-- Header -->
		<?php $this->load->view('includes/header'); ?>

		<!-- Banner -->
		<div id="banner-wrapper">
			<div id="banner" class="box container">
				<div class="row">
					<div class="col-7 col-12-medium">
						<h2><?php echo html_escape($settings[0]->jt_title); ?></h2>
						<p><?php echo html_escape($settings[0]->jt_text); ?></p>
					</div>
					<div class="col-5 col-12-medium">
						<ul>
							<li><a href="<?php echo base_url('rastgele-kitap'); ?>" class="button large icon fa-random"> Rastgele</a></li>
							<li><a href="<?php echo html_escape($settings[0]->set_hp_btn_link); ?>" target="blank" class="button alt large icon fa-question-circle"><?php echo html_escape($settings[0]->set_hp_btn_text); ?></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<!-- Features -->
		<div id="features-wrapper">
			<div class="container">
				<div class="row">

					<?php foreach($feedBooks as $book){ ?>
						<div class="col-2 col-6-medium col-12-small">
							<!-- Box -->
							<section class="box feature">
								<a href="<?php echo base_url('kitap/') . $book->book_slug; ?>" class="image featured"><img id="post_img" style="object-fit: cover;min-height: 340px!important;" src="<?php echo base_url($book->book_cover); ?>" alt="<?php echo $book->book_title; ?> indir, ekitap indir, pdf indir, epub indir, kitabı indir" /></a>
								<div class="inner">

									<h5 style="line-height: 2; text-align: center;">
										<a id="kitap-link" href="<?php echo base_url('kitap/') . $book->book_slug; ?>"><?php echo limitChars(html_escape($book->book_title), 20, '...'); ?></a>
									</h5>
									<p id="yazar-p"><a id="yazar-link" title="<?php echo getAuthorNameBySlug($book->book_author)->result()[0]->author_name; ?> kitapları indir" href="<?php echo base_url('yazar/') . $book->book_author; ?>"><?php echo getAuthorNameBySlug($book->book_author)->result()[0]->author_name; ?></a></p>
								</div>
							</section>
						</div>
					<?php } ?>

				</div>
			</div>
			<nav data-pagination>
			  <ul>
			   <?php echo $pagination; ?>
			  </ul>
			</nav>
		</div>

		<!-- Main -->
		<div id="main-wrapper">
			<div class="container">
				<div class="row gtr-200">
					<div class="col-4 col-12-medium">

						<!-- Sidebar -->
						<div id="sidebar">
							<section class="widget thumbnails">
								<div class="grid">
									<div class="row gtr-50">
										<div class="col-12"><a style="width: 100%;object-fit: cover;min-height: 400px;" href="<?php echo base_url('kitap/' . html_escape($randomBookBottom[0]->book_slug)); ?>" class="image fit"><img  src="<?php echo base_url($randomBookBottom[0]->book_cover); ?>" alt="<?php echo $randomBookBottom[0]->book_title . " - " . $randomBookBottom[0]->book_author ?> kitabı indir" /></a></div>
									</div>
								</div>
							</section>
						</div>

					</div>
					<div class="col-8 col-12-medium imp-medium">

						<!-- Content -->
						<div id="content">
							<section class="last">
								<h2><?php echo html_escape($randomBookBottom[0]->book_title); ?></h2>
								
								<p><?php echo limitChars($randomBookBottom[0]->book_text, 400); ?></p>
								<a href="<?php echo base_url('kitap/' . html_escape($randomBookBottom[0]->book_slug)); ?>" class="button icon fa-arrow-circle-right">Kitap Sayfasına Git</a>
							</section>
						</div>

					</div>
				</div>
			</div>
		</div>

		<?php $this->load->view('includes/footer'); ?>

	</body>
	</html>