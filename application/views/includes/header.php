<div id="header-wrapper">
	<header id="header" class="container">

		<!-- Logo -->
		<div id="logo">
			<h1><a href="<?php echo base_url(); ?>"><?php echo $settings[0]->set_logo_text; ?></a></h1>
		</div>

		<!-- Nav -->
		<nav id="nav">
			<ul>
				<li class="current"><a href="<?php echo base_url(); ?>">Anasayfa</a></li>
				<li>
					<a href="#">Kategoriler</a>
					<ul>
						<?php foreach ($getCategories as $cat){ ?>
							<li><a href="<?php echo base_url('kategori/' . html_escape($cat->cat_slug)); ?>"><?php echo html_escape($cat->cat_name); ?></a></li>
						<?php } ?>
					</ul>
				</li>

				<li>
					<a href="#">Sayfalar</a>
					<ul>
						<?php foreach ($pages as $pg){ ?>
							<li><a href="<?php echo base_url('sayfa/' . html_escape($pg->page_slug)); ?>"><?php echo html_escape($pg->page_title); ?></a></li>
						<?php } ?>
					</ul>
				</li>

			</ul>
		</nav>

	</header>
</div>
