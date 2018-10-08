		<footer>
			<div class="container-fluid">
				<p class="copyright">&copy; 2018 All Rights Reserved.</p>
			</div>
		</footer>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="<?php echo base_url('assets/admin-assets/'); ?>vendor/jquery/jquery.min.js"></script>
	<script src="<?php echo base_url('assets/admin-assets/'); ?>vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url('assets/admin-assets/'); ?>vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?php echo base_url('assets/admin-assets/'); ?>vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
	<script src="<?php echo base_url('assets/admin-assets/'); ?>vendor/chartist/js/chartist.min.js"></script>
	<script src="<?php echo base_url('assets/admin-assets/'); ?>scripts/klorofil-common.js"></script>
	<script src="<?php echo base_url('assets/admin-assets/'); ?>vendor/sweetalert/dist/sweetalert.min.js"></script>
	<script type="text/javascript">
		<?php if($this->session->flashdata('notification')){
			echo $this->session->flashdata('notification');
		} ?></script>