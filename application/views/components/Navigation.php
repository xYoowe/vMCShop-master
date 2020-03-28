<!--
 * Created with ♥ by Verlikylos on 03.05.2017 14:55.
 * Visit www.verlikylos.pro for more.
 * Copyright © vMCShop 2017
-->

<nav class="navbar navbar-fixed-top navbar-primary navbar-color-on-scroll navbar-transparent">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">
				<div class="logo-container">
					<div class="brand">
						<?php echo $this->config->item('page_title'); ?>
					</div>
				</div>
			</a>
		</div>
		<div class="collapse navbar-collapse" id="navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				<li <?php echo ($this->uri->rsegment('1') == "home") ? 'class="active"' : ''; ?>><a href="<?php echo ($this->uri->rsegment('1') == "home") ? '#"' : base_url(); ?>"><i class="fa fa-home" aria-hidden="true"></i> Strona Główna</a></li>
                <?php if ($servers): ?>
                    <?php $serversCount = count($servers); ?>
                    <?php if ($serversCount == 1): ?>
                        <?php foreach ($servers as $server): ?>
                            <li <?php echo ($this->uri->rsegment('1') == "shop") ? 'class="active"' : ''; ?>><a href="<?php echo ($this->uri->rsegment('1') == "shop") ? '#"' : base_url('shop/' . $server['name']); ?>"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Sklep</a></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Sklep <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header">Wybierz serwer</li>
                                <?php foreach ($servers as $server): ?>
                                    <li><a href="<?php echo base_url('shop/' . $server['name']); ?>">Serwer <?php echo $server['name']; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
                <li <?php echo ($this->uri->rsegment('1') == "voucher") ? 'class="active"' : ''; ?>><a href="<?php echo ($this->uri->rsegment('1') == "voucher") ? '#"' : base_url('voucher'); ?>"><i class="fa fa-key" aria-hidden="true"></i> Realizuj voucher</a></li>
                <?php if ($pages): ?>
                    <?php foreach ($pages as $page): ?>
                        <?php if ($page['active'] == 1): ?>
                            <li <?php echo (($this->uri->rsegment('1') == 'page') && ($this->uri->rsegment('3') == $page['id'])) ? 'class="active"' : ''; ?>><a <?php if (($page['link'] == 1) || ($page['link'] == true)) { echo 'href="' . $page['content'] . '"'; } else { echo 'href="'; echo (($this->uri->rsegment('1') == 'page') && ($this->uri->rsegment('3') == $page['id'])) ? '#"' : base_url('page/' . $page['id']); } echo '">'; ?><?php echo ((isset($page['icon'])) && ($page['icon'] != null)) ? '<i class="fa ' . $page['icon'] . ' fa-2x" aria-hidden="true"></i>' : ''; ?> <?php echo $page['title']; ?></a></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
			</ul>
		</div>
	</div>
</nav>