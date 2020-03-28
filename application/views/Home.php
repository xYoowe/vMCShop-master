<!--
 * Created with ♥ by Verlikylos on 02.05.2017 23:39.
 * Visit www.verlikylos.pro for more.
 * Copyright © vMCShop 2017
-->

<body>
	
	<div class="wrapper">
		
		<?php $this->load->view('components/Navigation'); ?>
		
		<div class="header header-filter" id="header" style="background-image: url('<?php echo $this->config->item('page_header_image'); ?>');">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center">
						<div class="brand-material">
							<h1><?php echo $this->config->item('page_header_title'); ?></h1>
							<h3><?php echo $this->config->item('page_header_subtitle'); ?></h3>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="main main-raised">
			<div class="section section">
				<div class="container">
					<div class="row">
						<div class="col-md-8">
							<div class="title">
								<h3><i class="fa fa-newspaper-o" aria-hidden="true"></i> Aktualności</h3>
							</div>
							<div class="row">
								<?php if (!$news): ?>

                                    <div class="col-xs-12">
                                        <div class="card card-raised">
                                            <div class="card-body">
                                                <h3 class="text-center"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Brak aktualności!</h3>
                                            </div>
                                        </div>
                                    </div>

                                <?php else: ?>

                                    <?php foreach ($news as $newsUnit): ?>

                                        <div class="col-xs-12">
                                            <div class="card card-raised" style="margin-bottom: 2em;">
                                                <div class="card-image">
                                                    <img class="card" src="<?php echo $newsUnit['image']; ?>" alt="<?php echo $newsUnit['title']; ?>" />
                                                </div>
                                                <div class="card-body">
                                                    <h3 class="card-title" style="margin-top: 0;"><?php echo $newsUnit['title']; ?></h3>

                                                    <p><?php echo $newsUnit['content']; ?></p>
                                                    <hr style="margin-bottom: 0;" />
                                                    <span class="pull-right" style="margin-top: 0.7em; margin-bottom: 0.7em;"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo formatDate($newsUnit['date']); ?></span>
                                                </div>
                                            </div>
                                        </div>

                                    <?php endforeach; ?>

                                <?php endif; ?>
							</div>
						</div>
						<div class="col-md-4">
							<div class="row">
								<div class="col-xs-12">
									<div class="title">
										<h3><i class="fa fa-server" aria-hidden="true"></i> Status Serwerów</h3>
									</div>
									<div class="row">
										<?php if (!$servers): ?>

                                            <div class="col-xs-12">
                                                <div class="card card-raised card-status">
                                                    <div class="card-body text-center">
                                                        <h3><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Brak serwerów!</h3>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php else: ?>

                                            <?php foreach ($servers as $server): ?>

                                                <div class="col-xs-12">
                                                    <div class="card card-raised card-status">
                                                        <div class="card-body text-center">
                                                            <h5>Serwer <?php echo $server['name']; ?></h5>

                                                            <?php if (!isset($server['status'])): ?>

                                                                <div class="progress">
                                                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                                                </div>
                                                                <span class="label label-danger">Offline</span>

                                                            <?php else: ?>

                                                                <?php
                                                                    if ($server['status']['MaxPlayers'] == 0) {
                                                                        $percent = 0;
                                                                    } else {
                                                                        $percent = round(($server['status']['Players'] / $server['status']['MaxPlayers']) * 100, 0);
                                                                    }
                                                                ?>

                                                                <div class="progress">
                                                                    <div class="progress-bar progress-bar-success" role="progressbar" style="width: <?php echo $percent; ?>%"></div>
                                                                </div>
                                                                <span class="label label-success">Online</span>
                                                                <span class="label label-info"><?php echo $server['status']['Players'] . "/" . $server['status']['MaxPlayers']; ?></span>

                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php endforeach; ?>

                                        <?php endif; ?>
									</div>
								</div>
								<div class="col-xs-12">

									<div class="title">
										<h3><i class="fa fa-history" aria-hidden="true"></i> Ostatnie Zakupy</h3>
									</div>

                                    <div class="card card-raised">
                                        <div class="card-body">

                                            <?php if (!$purchases): ?>

                                                <h3 class="text-center"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Nikt nie dokonał jeszcze zakupu!</h3>

                                            <?php else: ?>

                                                <?php foreach ($purchases as $purchase): ?>

                                                    <img class="last-buy-cell" data-toggle="tooltip" data-placement="top" title="<?php echo $purchase['buyer']; ?> | <?php echo $purchase['service']; ?> | Serwer <?php echo $purchase['server']; ?>" src="https://cravatar.eu/avatar/<?php echo $purchase['buyer']; ?>/48" alt="<?php echo $purchase['buyer']; ?>" /><div class="ripple-container"></div>

                                                <?php endforeach; ?>

                                            <?php endif; ?>

                                        </div>
                                    </div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>