<body>
    <div class="wrapper">

        <?php $this->load->view('panel/components/Sidebar'); ?>

        <div class="main-panel">
            <?php $this->load->view('panel/components/Navigation'); ?>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-7 col-md-6 col-sm-12">

                            <div class="card">
                                <div class="card-content table-responsive">
                                    <?php if (!$services): ?>

                                        <h3 style="margin-bottom: 20px;" class="text-center"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Brak Usług!</h3>

                                    <?php else: ?>

                                        <table class="table table-hover table-striped table-responsive">
                                            <thead class="text-success text-center">
                                                <th class="text-center">ID</th>
                                                <th class="text-center">Nazwa</th>
                                                <th class="text-center">Serwer</th>
                                                <th class="text-center">Kanał SMS</th>
                                                <th class="text-center">ID Kanału SMS</th>
                                                <th class="text-center">Numer SMS</th>
                                                <th class="text-center">Koszt PayPal</th>
                                                <th class="text-center">Opis, obrazek oraz komendy</th>
                                                <th class="text-center"></th>
                                            </thead>
                                            <tbody>

                                            <?php foreach ($services as $service): ?>

                                                <tr class="text-center">
                                                    <td><?php echo $service['id']; ?></td>
                                                    <td><?php echo $service['name']; ?></td>
                                                    <td><?php echo $service['server']; ?></td>
                                                    <td><?php echo ($service['sms_channel'] == null) ? "Brak" : $service['sms_channel']; ?></td>
                                                    <td><?php echo ($service['sms_channel_id'] == null) ? "Brak" : ($service['sms_channel_id'] == 0) ? "Nie dotyczy" : $service['sms_channel_id']; ?></td>
                                                    <td><?php echo ($service['sms_number'] == null) ? "Brak" : $service['sms_number'] . " - " . getPriceNetto($service['sms_number'], $smsOperator) . "zł (" . getPriceBrutto($service['sms_number'], $smsOperator) . "zł z VAT)"; ?></td>
                                                    <td><?php echo ($service['paypal_cost'] == null) ? "Brak" : number_format(round($service['paypal_cost'], 2), 2, ',', ' ') . "zł"; ?></td>
                                                    <td><button class="btn btn-xs btn-info" style="margin: 0;" data-toggle="modal" data-target="#service<?php echo $service['id']; ?>"><i class="fa fa-search" aria-hidden="true"></i> Podgląd</button></td>
                                                    <td class="td-actions">

                                                        <?php echo form_open(base_url('panel/services/edit')); ?>

                                                        <input type="hidden" name="serviceId" value="<?php echo $service['id']; ?>">

                                                        <button type="submit" class="btn btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>

                                                        <?php echo form_close(); ?>


                                                        <?php echo form_open(base_url('panel/services/remove'), array('class' => 'inline-form')); ?>

                                                        <input type="hidden" name="serviceId" value="<?php echo $service['id']; ?>">

                                                        <button type="submit" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></button>

                                                        <?php echo form_close(); ?>

                                                    </td>
                                                </tr>

                                            <?php endforeach; ?>

                                            </tbody>
                                        </table>

                                    <?php endif; ?>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">

                            <div class="card">
                                <div class="card-header" data-background-color="primary">
                                    <h4 style="margin-bottom: 0; margin-top: 0;" class="title"><i class="fa fa-plus-square" aria-hidden="true"></i> Dodaj usługę</h4>
                                </div>
                                <div class="card-content">

                                    <?php if (!$servers): ?>

                                        <h4 style="margin-bottom: 20px;" class="text-center"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Aby utworzyć usługę najpierw dodaj serwer!</h4>

                                    <?php else: ?>

                                        <?php echo form_open_multipart(base_url('panel/services/create')); ?>

                                            <div class="col-lg-6 col-md-12 col-xs-12 text-center">
                                                <div class="form-group label-floating is-empty text-left">
                                                    <label class="control-label">Nazwa usługi</label>
                                                    <input type="text" name="serviceName" class="form-control" required>
                                                    <span class="material-input"></span>
                                                </div>
                                                <br />
                                                <div class="btn-group bootstrap-select">
                                                    <select name="serviceServer" class="selectpicker" data-style="select-with-transition" title="Wybierz serwer" data-size="7" tabindex="-98" required>
                                                        <option disabled=""> Wybierz serwer</option>

                                                        <?php foreach ($servers as $server): ?>

                                                            <option value="<?php echo $server['id']; ?>">Serwer <?php echo $server['name']; ?></option>

                                                        <?php endforeach; ?>

                                                    </select>
                                                </div>
                                                <br />
                                                <div class="form-group text-left">
                                                    <label>Opis usługi</label>
                                                    <textarea id="serviceDesc" name="serviceDesc" class="form-control"></textarea>
                                                    <span class="material-input"></span>
                                                </div>
                                                <br />
                                                <div class="form-group text-left">
                                                    <input type="file" id="serviceImage" name="serviceImage" style="cursor: pointer;" accept="image/*" required>
                                                    <div class="input-group">
                                                        <span class="input-group-btn input-group-sm">
                                                            <button type="button" class="btn btn-success">
                                                                <i class="fa fa-upload" aria-hidden="true"></i>
                                                             </button>
                                                        </span>
                                                        <input type="text" readonly="" class="form-control" placeholder="Wybierz obrazek dla usługi">
                                                    </div>
                                                </div>
                                                <?php if ($smsOperator == "LvlUp"): ?>
                                                    <input type="hidden" name="serviceSmsChannel" value="" />
                                                    <input type="hidden" name="serviceSmsChannelId" value="" />
                                                <?php elseif ($smsOperator == "MicroSMS"): ?>
                                                    <br />
                                                    <div class="form-group label-floating is-empty text-left">
                                                        <label class="control-label">Kanał SMS</label>
                                                        <input type="text" name="serviceSmsChannel" class="form-control">
                                                        <span class="material-input"></span>
                                                    </div>
                                                    <br />
                                                    <div class="form-group label-floating is-empty text-left">
                                                        <label class="control-label">ID kanału SMS</label>
                                                        <input type="text" name="serviceSmsChannelId" class="form-control">
                                                        <span class="material-input"></span>
                                                    </div>
                                                <?php elseif ($smsOperator == "Homepay"): ?>
                                                    <br />
                                                    <div class="form-group label-floating is-empty text-left">
                                                        <label class="control-label">Identyfikator SMS</label>
                                                        <input type="text" name="serviceSmsChannel" class="form-control">
                                                        <span class="material-input"></span>
                                                    </div>
                                                    <br />
                                                    <div class="form-group label-floating is-empty text-left">
                                                        <label class="control-label">ID konta SMS</label>
                                                        <input type="text" name="serviceSmsChannelId" class="form-control">
                                                        <span class="material-input"></span>
                                                    </div>
                                                <?php elseif ($smsOperator == "Pukawka"): ?>
                                                    <input type="hidden" name="serviceSmsChannel" value="" />
                                                    <input type="hidden" name="serviceSmsChannelId" value="" />
                                                <?php endif; ?>
                                                <br />
                                                <div class="btn-group bootstrap-select">
                                                    <select name="serviceSmsNumber" class="selectpicker" data-style="select-with-transition" title="Wybierz numer SMS" data-size="7" tabindex="-98">
                                                        <option disabled=""> Wybierz numer SMS</option>

                                                        <?php foreach ($smsnumbers as $number => $cost): ?>

                                                            <option value="<?php echo $number; ?>"><?php echo $number; ?> - <?php echo $cost; ?>zł (<?php echo getPriceBrutto($number, $smsOperator); ?>zł z VAT)</option>

                                                        <?php endforeach; ?>

                                                    </select>
                                                </div>
                                                <br />
                                                <div class="form-group label-floating is-empty text-left">
                                                    <label class="control-label">Koszt PayPal</label>
                                                    <input type="text" name="servicePaypalCost" class="form-control">
                                                    <span class="material-input"></span>
                                                </div>
                                                <div class="form-group label-floating is-empty text-left">
                                                    <label class="control-label">Komendy</label>
                                                    <textarea name="serviceCommands" class="form-control" required></textarea>
                                                    <span class="material-input"></span>
                                                </div>
                                                <br />
                                                <button class="btn btn-success text-center"><i class="fa fa-plus-square" aria-hidden="true"></i>&nbsp;&nbsp;Dodaj usługę</button>
                                                <br />
                                                <br />
                                            </div>

                                        <?php echo form_close(); ?>



                                        <div class="col-lg-6 col-md-12 col-xs-12">
                                            <h6 class="text-center" style="text-transform: none;">Aktualnie płatności SMS obsługuje: <strong><?php echo $smsOperator; ?></strong></h6>
                                            <h6 style="text-transform: none; font-weight: bold;">Informacja:</h6>
                                            <p><strong>Serwer</strong> - Wybierz serwer, na ktorym ma zostać zrealizowana usługa po pomyślnym dokonaniu płatności.</p>
                                            <p><strong>Obrazek usługi</strong> - Maksymalna waga to 10MB. Maksymalne wymiary 360x360 pikseli.</p>
                                            <p><strong>Koszt PayPal</strong> - Cena usługi przy płatności PayPal. <strong>Płatność PayPal nie jest jeszcze obsługiwana przez sklep.</strong> (Jeżeli nie chcesz korzystać z płatności PayPal dla tej usługi pozostaw to pole puste)</p>
                                            <p><strong>Komendy</strong> - Komendy, które zostaną wysłane na serwer po dokonaniu płatności przez użytkownika. Zamiast nicku gracza użyj "{PLAYER}" (bez cudzysłowi). Komendy oddzielaj średnikiem bez znaków nowej lini.</p>
                                            <br /><br />
                                            <?php if ($smsOperator == "LvlUp"): ?>
                                                <p><strong>Numer SMS</strong> - Wybierz numer SMS jednocześnie określający koszt jego wysłania. (Jeżeli nie chcesz korzystać z płatności SMS Premium dla tej usługi pozostaw wartość domyślną)</p>
                                            <?php elseif ($smsOperator == "MicroSMS"): ?>
                                                <p><strong>Kanał SMS</strong> - Znajdziesz go w panelu na stronie MicroSMS. Jest jednocześnie treścią SMSa. (Jeżeli nie chcesz korzystać z płatności SMS Premium dla tej usługi pozostaw to pole puste)</p>
                                                <p><strong>ID kanału SMS</strong> - Znajdziesz go w panelu na stronie MicroSMS. Jest to numer identyfikacyjny kanału SMS. (Jeżeli nie chcesz korzystać z płatności SMS Premium dla tej usługi pozostaw to pole puste)</p>
                                                <p><strong>Numer SMS</strong> - Wybierz numer SMS jednocześnie określający koszt jego wysłania. (Jeżeli nie chcesz korzystać z płatności SMS Premium dla tej usługi pozostaw wartość domyślną)</p>
                                            <?php elseif ($smsOperator == "Homepay"): ?>
                                                <p><strong>Identyfikator SMS</strong> - Znajdziesz go podczas przeglądania listy Twoich kont SMS Premium w panelu Homepay. (Jeżeli nie chcesz korzystać z płatności SMS Premium dla tej usługi pozostaw to pole puste)</p>
                                                <p><strong>ID konta SMS</strong> - Znajdziesz je podczas przeglądania listy Twoich kont SMS Premium w panelu Homepay. (Jeżeli nie chcesz korzystać z płatności SMS Premium dla tej usługi pozostaw to pole puste)</p>
                                                <p><strong>Numer SMS</strong> - Znajdziesz go podczas przeglądania listy Twoich kont SMS Premium w panelu Homepay. (Jeżeli nie chcesz korzystać z płatności SMS Premium dla tej usługi pozostaw wartość domyślną)</p>
                                            <?php elseif ($smsOperator == "Pukawka"): ?>
                                                <p><strong>Numer SMS</strong> - Wybierz numer SMS jednocześnie określający koszt jego wysłania. (Jeżeli nie chcesz korzystać z płatności SMS Premium dla tej usługi pozostaw wartość domyślną)</p>
                                            <?php endif; ?>
                                        </div>

                                    <?php endif; ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

