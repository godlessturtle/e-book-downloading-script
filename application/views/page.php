<!DOCTYPE HTML>
<html>
<head>
	<title>Sayfa</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<meta name="description" content="<?php echo $settings[0]->set_desc; ?>">
	<meta name="keywords" content="<?php echo $settings[0]->set_keyw; ?>">
	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/main.css" />
</head>
<body class="is-preload no-sidebar">
	<div id="page-wrapper">

		<?php $this->load->view('includes/header'); ?>

		<!-- Main -->
		<div id="main-wrapper">
			<div class="container">
				<div id="content">

					<!-- Content -->
					<article>

						<h2><?php echo html_escape($page[0]->page_title); ?></h2>

						<p><?php echo $page[0]->page_text; ?></p>

					</article>

				</div>
			</div>
		</div>

		<?php $this->load->view('includes/footer'); ?>
	</body>
	</html>