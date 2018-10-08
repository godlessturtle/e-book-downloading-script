<!DOCTYPE HTML>
<html lang="tr">
<head>
	<title><?php echo html_escape($single->book_title); ?> - <?php echo getAuthorNameBySlug($single->book_author)->result()[0]->author_name; ?> <?php echo html_escape($settings[0]->set_suffix); ?></title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<meta name="description" content="<?php echo $settings[0]->set_desc; ?>">
	<meta name="keywords" content="<?php echo $settings[0]->set_keyw; ?>">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css" />
</head>
<body class="is-preload left-sidebar">
	<div id="page-wrapper">
		<?php $this->load->view('includes/header'); ?>

		<!-- Main -->
		<div id="main-wrapper">
			<div class="container">
				<div class="row gtr-200">
					<div class="col-4 col-12-medium">
						<div id="sidebar">

							<!-- Sidebar -->
							<section>
								<p>
									<img style="width: 100%;" alt="<?php echo $single->book_title . " - " . $single->book_author; ?> kitabı indir" src="<?php echo base_url($single->book_cover); ?>">
								</p>
								<footer>
									<a title="<?php echo html_escape($single->book_title . " - " . $single->book_author); ?>" style="width: 100%;text-align: center;" target="blank" href="<?php echo $single->book_dl_link; ?>" class="button icon fa-download"> Bu Kitabı İndir</a>
								</footer>
							</section>

						</div>
					</div>
					<div class="col-8 col-12-medium">
						<div id="content">

							<!-- Content -->
							<article>

								<h2><?php echo html_escape($single->book_title); ?></h2>

								<p><?php echo $single->book_text; ?></p>

							</article>

						</div>
					</div>

				</div>
			</div>
		</div>

		<?php $this->load->view('includes/footer'); ?>
</body>
</html>