<body>
<div class="wrapper">

    <?php $this->load->view('panel/components/Sidebar'); ?>

    <div class="main-panel">
        <?php $this->load->view('panel/components/Navigation'); ?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header" data-background-color="success">
                                <i class="fa fa-server" aria-hidden="true"></i>
                            </div>
                            <div class="card-content">
                                <p class="category">Obsługiwane serwery</p>
                                <h3 class="title"><?php echo $serversCount; ?></h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <a class="link-d-reverse" href="<?php echo base_url('panel/servers'); ?>"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Zarządzanie serwerami</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header" data-background-color="success">
                                <i class="fa fa-users" aria-hidden="true"></i>
                            </div>
                            <div class="card-content">
                                <p class="category">Administratorzy</p>
                                <h3 class="title"><?php echo $usersCount; ?></h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <a class="link-d-reverse" href="<?php echo base_url('panel/users'); ?>"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Zarządzanie użytkownikami</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header" data-background-color="success">
                                <i class="fa fa-diamond" aria-hidden="true"></i>
                            </div>
                            <div class="card-content">
                                <p class="category">Sprzedane usługi</p>
                                <h3 class="title"><?php echo $purchasesCount; ?></h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <a class="link-d-reverse" href="<?php echo base_url('panel/purchases'); ?>"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Historia zakupów</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header" data-background-color="success">
                                <i class="fa fa-usd" aria-hidden="true"></i>
                            </div>
                            <div class="card-content">
                                <p class="category">Zyski</p>
                                <h3 class="title"><?php echo $profit; ?> zł</h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <a class="link-d-reverse" href="<?php echo base_url('panel/purchases'); ?>"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Historia zakupów</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-header card-chart" data-background-color="primary">
                                <div class="ct-chart" id="weekPurchases"></div>
                            </div>
                            <div class="card-content">
                                <h4 class="title"><i class="fa fa-line-chart" aria-hidden="true"></i> Statystyki sprzedaży w tym tygodniu</h4>

                                <?php if ($percentTransactions == 0): ?>
                                    <p class="category">Tyle samo transakcji co wczoraj.</p>
                                <?php endif; ?>

                                <?php if ($percentTransactions < 0): ?>
                                    <p class="category"><span class="text-danger"><i class="fa fa-long-arrow-down" aria-hidden="true"></i>&nbsp;<?php echo str_replace("-", "", $percentTransactions); ?>%</span> transakcji mniej niż wczoraj.</p>
                                <?php endif; ?>

                                <?php if ($percentTransactions > 0): ?>
                                    <p class="category"><span class="text-success"><i class="fa fa-long-arrow-up" aria-hidden="true"></i>&nbsp;<?php echo str_replace("-", "", $percentTransactions); ?>%</span> transakcji więcej niż wczoraj.</p>
                                <?php endif; ?>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="material-icons">access_time</i> Dane aktualizują się po odświeżeniu strony.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-header" data-background-color="primary">
                                <h4 class="title" style="margin-bottom: 0; margin-top: 0;"><i class="fa fa-server" aria-hidden="true"></i> Status serwerów</h4>
                            </div>
                            <div class="card-content table-responsive">

                                <?php if (!$servers): ?>

                                <h3 class="text-center"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Brak serwerów!</h3>

                                <?php else: ?>

                                    <table class="table table-hover table-striped table-responsive">
                                        <tbody>

                                            <?php foreach ($servers as $server): ?>

                                                <tr>
                                                    <td class="text-center">Serwer <?php echo $server['name']; ?></td>

                                                    <?php if (!isset($server['status'])): ?>

                                                        <td class="text-center"><span class="label label-danger">Offline</span></td>
                                                        <td class="text-center">0/0</td>

                                                    <?php else: ?>

                                                        <td class="text-center"><span class="label label-success">Online</span></td>
                                                        <td class="text-center"><?php echo $server['status']['Players'] . "/" . $server['status']['MaxPlayers']; ?></td>

                                                    <?php endif; ?>

                                                </tr>

                                            <?php endforeach; ?>

                                        </tbody>
                                    </table>

                                <?php endif; ?>

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-header" data-background-color="primary">
                                <h4 class="title" style="margin-bottom: 0; margin-top: 0;"><i class="fa fa-info" aria-hidden="true"></i> Informacje o skrypcie</h4>
                            </div>
                            <div class="card-content table-responsive">
                                <table class="table table-hover table-responsive">
                                    <tbody>
                                        <tr>
                                            <td class="text-left">Autor:</td>
                                            <td class="text-right">Verlikylos</td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Pomoc techniczna:</td>
                                            <td class="text-right">kontakt@verlikylos.pro</td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Wersja:</td>
                                            <td class="text-right"><?php echo $this->config->item('script_version'); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="card card-nav-tabs">
                            <div class="card-header" data-background-color="primary">
                                <div class="nav-tabs-navigation">
                                    <div class="nav-tabs-wrapper">
                                        <span class="nav-tabs-title"><i class="fa fa-history" aria-hidden="true"></i> Ostatnie zakupy:</span>

                                        <?php if ($servers): ?>

                                            <ul class="nav nav-tabs" data-tabs="tabs">

                                                <?php $i = 0; ?>

                                                <?php foreach ($servers as $server): ?>

                                                    <li<?php echo ($i == 0) ? ' class="active"' : ''; ?>>
                                                        <a href="#server<?php echo $server['id']; ?>" data-toggle="tab">
                                                            Serwer <?php echo $server['name']; ?>
                                                            <div class="ripple-container"></div></a>
                                                    </li>

                                                    <?php $i++; ?>

                                                <?php endforeach; ?>

                                            </ul>
											
										<?php else: ?>
										
											<ul class="nav nav-tabs" data-tabs="tabs">
											</ul>

                                        <?php endif; ?>



                                    </div>
                                </div>
                            </div>

                            <div class="card-content">
                                <div class="tab-content">

                                    <?php if (!$purchases): ?>

                                        <h3 class="text-center"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Nikt nie dokonał jeszcze zakupu!</h3>

                                    <?php else: ?>

                                        <?php if (!$servers): ?>

                                            <h3 class="text-center"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Brak serwerów!</h3>

                                        <?php else: ?>

                                            <?php $i = 0; ?>

                                            <?php foreach ($servers as $server): ?>

                                                <div class="tab-pane<?php echo ($i == 0) ? ' active' : ''; ?>" id="server<?php echo $server['id']; ?>">
                                                    <table class="table table-hover table-striped table-responsive">
                                                        <thead class="text-success">
                                                            <th class="text-center">Klient</th>
                                                            <th class="text-center">Usługa</th>
                                                            <th class="text-center">Metoda Płatności</th>
                                                            <th class="text-center">Zysk</th>
                                                        </thead>
                                                    <tbody>

                                                        <?php foreach ($purchases as $purchase): ?>

                                                            <?php if ($purchase['server'] == $server['name']): ?>

                                                                <tr>
                                                                    <td class="text-center"><?php echo $purchase['buyer']; ?></td>
                                                                    <td class="text-center"><?php echo $purchase['service']; ?></td>
                                                                    <td class="text-center"><?php echo $purchase['method']; ?></td>
                                                                    <td class="text-center"><?php echo $purchase['profit']; ?> PLN</td>
                                                                </tr>

                                                            <?php endif; ?>

                                                        <?php endforeach; ?>

                                                        </tbody>
                                                    </table>
                                                </div>

                                                <?php $i++; ?>

                                            <?php endforeach; ?>

                                        <?php endif; ?>

                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-header" data-background-color="primary">
                                <h4 class="title"><i class="fa fa-clock-o" aria-hidden="true"></i> Historia logowań</h4>
                                <p class="category">Ostatnie logowania do panelu</p>
                            </div>
                            <div class="card-content table-responsive">
                                <?php if (!$logs): ?>

                                    <h3 style="margin-bottom: 20px;" class="text-center"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Brak Logów!</h3>

                                <?php else: ?>

                                    <table class="table table-hover table-striped table-responsive">
                                        <thead class="text-success">
                                            <th class="text-center">Użytkownik</th>
                                            <th class="text-center">Adres IP</th>
                                            <th class="text-center">Data</th>
                                            </thead>
                                        <tbody>

                                            <?php foreach ($logs as $log): ?>

                                                <tr>
                                                    <td class="text-center"><?php echo $log['user']; ?></td>
                                                    <td class="text-center"><?php echo $log['details']; ?></td>
                                                    <td class="text-center"><?php echo formatDate($log['date']); ?></td>
                                                </tr>

                                            <?php endforeach; ?>

                                        </tbody>
                                    </table>

                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>