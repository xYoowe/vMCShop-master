<!--
 * Created with ♥ by Verlikylos on 03.05.2017 00:19.
 * Visit www.verlikylos.pro for more.
 * Copyright © vMCShop 2017
-->

		<footer class="footer-big">
			<div class="container">
				<div class="copyright pull-left">
					Generated in <?php echo $benchmark; ?>s
				</div>
				<div class="copyright pull-right">
					Proudly powered by <a class="link-reverse" href="https://verlikylos.pro/">vMCShop</a> v<?php echo $this->config->item('script_version'); ?>
				</div>
			</div>
		</footer>
		<?php $this->load->view('components/Scripts'); ?>
    </body>
</html>