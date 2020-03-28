<body>
    <div class="wrapper">

        <?php $this->load->view('panel/components/Sidebar'); ?>

        <div class="main-panel">
            <?php $this->load->view('panel/components/Navigation'); ?>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <?php if (isset($_SESSION['vouchers'])): ?>
                            <div class="col-xs-12">
                                <div class="alert alert-info text-left">
                                    <div class="container-fluid">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        </button>
                                        <?php echo $_SESSION['vouchers']; ?>
                                    </div>
                                </div>
                            </div>
                            <?php unset($_SESSION['vouchers']); ?>
                        <?php endif; ?>
                        <div class="col-md-8 col-sm-12">

                            <div class="card">
                                <div class="card-content table-responsive">
                                    <?php if (!$vouchers): ?>

                                        <h3 style="margin-bottom: 20px;" class="text-center"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Brak Voucherów!</h3>

                                    <?php else: ?>

                                        <table class="table table-hover table-striped table-responsive">
                                            <thead class="text-success text-center">
                                            <th class="text-center">ID</th>
                                            <th class="text-center">Usługa</th>
                                            <th class="text-center">Serwer</th>
                                            <th class="text-center">Kod</th>
                                            <th class="text-center"></th>
                                            </thead>
                                            <tbody>

                                            <?php foreach ($vouchers as $voucher): ?>

                                                <tr class="text-center">
                                                    <td><?php echo $voucher['id']; ?></td>
                                                    <td><?php echo $voucher['service']; ?></td>
                                                    <td><?php echo $voucher['server']; ?></td>
                                                    <td><?php echo $voucher['code']; ?></td>
                                                    <td class="td-actions">

                                                        <?php echo form_open(base_url('panel/vouchers/remove')); ?>

                                                        <input type="hidden" name="voucherId" value="<?php echo $voucher['id']; ?>">

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
                        <div class="col-md-4 col-sm-12">

                            <div class="card">
                                <div class="card-header" data-background-color="primary">
                                    <h4 style="margin-bottom: 0; margin-top: 0;" class="title"><i class="fa fa-plus-square" aria-hidden="true"></i> Dodaj voucher</h4>
                                </div>
                                <div class="card-content">

                                    <?php if (!$services): ?>

                                        <h4 style="margin-bottom: 20px;" class="text-center"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Aby utworzyć voucher najpierw dodaj usługę!</h4>

                                    <?php else: ?>

                                        <?php echo form_open(base_url('panel/vouchers/create')); ?>

                                            <div class="col-xs-12 text-center">
                                                <div class="btn-group bootstrap-select">
                                                    <select name="voucherService" class="selectpicker" data-style="select-with-transition" title="Wybierz usługę" data-size="7" tabindex="-98" required>
                                                        <option disabled=""> Wybierz usługę</option>

                                                        <?php foreach ($services as $service): ?>

                                                            <option value="<?php echo $service['id']; ?>">Serwer <?php echo $service['server']; ?> - <?php echo $service['name']; ?></option>

                                                        <?php endforeach; ?>

                                                    </select>
                                                </div>
                                                <br />
                                                <br />
                                                <div class="btn-group bootstrap-select">
                                                    <select name="voucherAmount" class="selectpicker" data-style="select-with-transition" title="Wybierz ilość voucherów" data-size="7" tabindex="-98" required>
                                                        <option disabled=""> Wybierz ilość voucherów</option>

                                                        <?php for ($i = 1; $i <= 20; $i++): ?>

                                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>

                                                        <?php endfor; ?>

                                                    </select>
                                                </div>
                                                <br />
                                                <br />
                                                <button class="btn btn-success text-center"><i class="fa fa-plus-square" aria-hidden="true"></i>&nbsp;&nbsp;Dodaj voucher</button>
                                                <br />
                                                <br />
                                            </div>

                                        <?php echo form_close(); ?>

                                    <?php endif; ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>