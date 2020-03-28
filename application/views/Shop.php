<!--
 * Created with ♥ by Verlikylos on 03.05.2017 14:57.
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
						<div class="col-xs-12">
							<div class="title">
								<h3><i class="fa fa-shopping-cart" aria-hidden="true"></i> Sklep Serwera <?php echo $server['name']; ?></h3>
							</div>
							<div class="row">
                                <?php if (isset($_SESSION['messageDanger'])): ?>
                                    <div class="col-xs-12">
                                        <div class="alert alert-danger text-left">
                                            <div class="container-fluid">
                                                <div class="alert-icon">
                                                    <i class="material-icons">error_outline</i>
                                                </div>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                </button>
                                                <?php echo $_SESSION['messageDanger']; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php unset($_SESSION['messageDanger']); ?>
                                <?php endif; ?>
                                <?php if (isset($_SESSION['messageSuccess'])): ?>
                                    <div class="col-xs-12">
                                        <div class="alert alert-success text-left">
                                            <div class="container-fluid">
                                                <div class="alert-icon">
                                                    <i class="material-icons">check</i>
                                                </div>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                </button>
                                                <?php echo $_SESSION['messageSuccess']; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php unset($_SESSION['messageSuccess']); ?>
                                <?php endif; ?>
								<?php foreach ($services as $service): ?>
									<div class="col-xs-12 col-md-4">
										<div class="card card-raised card-buy">
											<div class="card-image">
												<img class="card" style="max-height: 360px; min-height: 360px;" src="<?php echo $service['image']; ?>" alt="<?php echo $service['name']; ?>" />
											</div>
											<div class="card-body text-center">
												<h4 class="card-title"><?php echo $service['name']; ?></h4>
                                                <?php if (isset($service['sms_channel']) && isset($service['sms_channel_id']) && isset($service['sms_number'])): ?>
                                                    <button style="text-transform: none" type="button" class="btn btn-info">
                                                            <i class="fa fa-mobile" aria-hidden="true"></i> SMS: <?php echo getPriceBrutto($service['sms_number'], $smsOperator); ?> zł
                                                    </button>
                                                <?php endif; ?>
                                                <?php if (isset($service['paypal_cost'])): ?>
                                                    <button style="text-transform: none" type="button" class="btn btn-info">
                                                        <i class="fa fa-paypal" aria-hidden="true"></i> PayPal: <?php echo $service['paypal_cost']; ?> zł
                                                    </button>
                                                <?php endif; ?>
												<br />
												<button class="btn btn-success-o" data-toggle="modal" data-target="#service<?php echo $service['id']; ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Kup</button>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	
	</div>

	<!-- Modals -->
    <?php foreach ($services as $service): ?>

        <div class="modal fade" id="service<?php echo $service['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <i class="material-icons">clear</i>
                        </button>
                        <h4 class="modal-title"><?php echo $service['name']; ?></h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-warning">
                            <div class="container-fluid">
                                <div class="alert-icon">
                                    <i class="material-icons">warning</i>
                                </div>
                                Pamiętaj, aby być <strong>ONLINE</strong> na serwerze przy zakupie usługi! (Nie dotyczy unbanów, wejściówek, itd.)
                                Podczas zakupu przedmiotu zwolnij miejsce w ekwipunku!
                            </div>
                        </div>
                        <div class="card card-nav-tabs">
                            <div class="header header-primary">
                                <div class="nav-tabs-navigation">
                                    <div class="nav-tabs-wrapper">
                                        <ul class="nav nav-tabs nav-justified" data-tabs="tabs">
                                            <li class="active">
                                                <a href="#description<?php echo $service['id']; ?>" data-toggle="tab" aria-expanded="false">
                                                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                                                    Opis Usługi
                                                </a>
                                            </li>
                                            <?php if (isset($service['sms_channel']) && isset($service['sms_channel_id']) && isset($service['sms_number'])): ?>
                                                <li>
                                                    <a href="#sms<?php echo $service['id']; ?>" data-toggle="tab" aria-expanded="false">
                                                        <i class="fa fa-mobile" aria-hidden="true"></i>
                                                        Płatność SMS
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (isset($service['paypal_cost'])): ?>
                                                <li>
                                                    <a href="#paypal<?php echo $service['id']; ?>" data-toggle="tab" aria-expanded="false">
                                                        <i class="fa fa-paypal" aria-hidden="true"></i>
                                                        Płatność PayPal
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="content">
                                <div class="tab-content">
                                    <div class="tab-pane active text-left" id="description<?php echo $service['id']; ?>">
                                        <?php echo $service['description']; ?>
                                    </div>
                                    <div class="tab-pane text-center" id="sms<?php echo $service['id']; ?>">
                                        <button style="text-transform: none" type="button" class="btn btn-info">
                                            <i class="fa fa-usd" aria-hidden="true"></i> Koszt: <?php echo getPriceBrutto($service['sms_number'], $smsOperator); ?> zł z VAT
                                        </button>
                                        <h6 style="text-transform: none;">
                                            Aby aktywować usługę, wyślij SMS o treści <strong><?php echo $service['sms_channel']; ?></strong> pod numer <strong><?php echo $service['sms_number']; ?></strong>.
                                            <br />
                                            Otrzymany kod wprowadź poniżej.
                                        </h6>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-8 col-md-offset-2">
                                                <?php echo form_open(base_url('checkout/sms')); ?>
                                                    <div class="form-group label-floating text-left">
                                                        <label class="control-label">Twój nick z gry</label>
                                                        <input type="text" name="username" class="form-control" required />
                                                    </div>
                                                    <div class="form-group label-floating text-left">
                                                        <label class="control-label">Otrzymany kod</label>
                                                        <input type="text" name="smscode" class="form-control" required />
                                                    </div>
                                                    <input type="hidden" name="serviceid" value="<?php echo $service['id']; ?>" />
                                                    <input type="hidden" name="servername" value="<?php echo $server['name']; ?>" />
                                                    <div class="form-group text-center">
                                                        <button type="submit" class="btn btn-success-o"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Zakup Usługę</button>
                                                    </div>
                                                <?php echo form_close(); ?>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="text-center">
                                        <?php if ($smsOperator == "MicroSMS"): ?>
                                            <img class="img-responsive" src="<?php echo base_url('assets/images/microsms.png'); ?>" alt="MicroSMS.pl" />
                                            <p>
                                                Płatności zapewnia firma <a class="link-reverse" href="http://microsms.pl/">MicroSMS</a>. Korzystanie z serwisu jest jednoznaczne z akceptacją <a class="link-reverse" href="http://microsms.pl/partner/documents/">regulaminów</a>. Jeśli nie dostałeś kodu zwrotnego w ciągu 30 minut skorzystaj z <a class="link-reverse" href="http://microsms.pl/customer/complaint/">formularza reklamacyjnego</a>.
                                            </p>
                                        <?php elseif ($smsOperator == "LvlUp"): ?>
                                            <img class="img-responsive center-block" src="<?php echo base_url('assets/images/logo_dotpay.jpg'); ?>" alt="DotPay.pl" />
                                            <p>
                                                Płatności zapewnia firma <a class="link-reverse" href="http://dotpay.pl/">DotPay</a>. Korzystanie z serwisu jest jednoznaczne z akceptacją <a class="link-reverse" href="http://www.dotpay.pl/regulamin-serwisow-sms-premium/">regulaminów</a>. Jeśli nie dostałeś kodu zwrotnego w ciągu 30 minut skorzystaj z <a class="link-reverse" href="https://www.dotpay.pl/kontakt/uslugi-sms-premium/">formularza reklamacyjnego</a>.
                                            </p>
                                        <?php elseif ($smsOperator == "Homepay"): ?>
                                            <img class="img-responsive center-block" src="<?php echo base_url('assets/images/homepay.png'); ?>" alt="Homepay.pl" />
                                            <p>
                                                Płatności zapewnia firma <a class="link-reverse" href="http://homepay.pl/">Homepay</a>. Korzystanie z serwisu jest jednoznaczne z akceptacją <a class="link-reverse" href="http://homepay.pl/regulamin">regulaminów</a>. Jeśli nie dostałeś kodu zwrotnego w ciągu 30 minut skorzystaj z <a class="link-reverse" href="https://homepay.pl/reklamacje">formularza reklamacyjnego</a>. Numer infolinii: <a class="link-reverse" href="tel://+48222668525">+48 (22) 266 85 25</a>.
                                            </p>
                                        <?php elseif ($smsOperator == "Pukawka"): ?>
                                            <img class="img-responsive center-block" src="<?php echo base_url('assets/images/pukawka.png'); ?>" alt="Pukawka.pl" />
                                            <p>
                                                Płatności zapewnia firma <a class="link-reverse" href="http://pukawka.pl/">Pukawka</a>. Korzystanie z serwisu jest jednoznaczne z akceptacją <a class="link-reverse" href="http://pukawka.pl/regulamin_sms.html">regulaminów</a>. Jeśli nie dostałeś kodu zwrotnego w ciągu 30 minut skorzystaj z <a class="link-reverse" href="https://admin.pukawka.pl/?page=wallet&do=reklamacjasms">formularza reklamacyjnego</a>.
                                            </p>
                                        <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php if (isset($service['paypal_cost'])): ?>
                                        <div class="tab-pane text-center" id="paypal<?php echo $service['id']; ?>">
                                            <button style="text-transform: none" type="button" class="btn btn-info">
                                                <i class="fa fa-usd" aria-hidden="true"></i> Koszt: <?php echo $service['paypal_cost']; ?> zł z VAT
                                            </button>
                                            <h6 style="text-transform: none;">
                                                Aby aktywować usługę, podaj swój nick i przejdź dalej.
                                            </h6>
                                            <div class="row">
                                                <div class="col-xs-12 col-md-8 col-md-offset-2">
                                                    <div class="form-group label-floating text-left">
                                                        <label class="control-label">Twój nick z gry</label>
                                                        <input type="text" class="form-control" disabled />
                                                    </div>
                                                    <div class="form-group text-center">
                                                        <button class="btn btn-danger" disabled><i class="fa fa-shopping-cart" aria-hidden="true"></i> Przejdź do płatności</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php endforeach; ?>