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
                                    <?php if (!$servers): ?>

                                        <h3 style="margin-bottom: 20px;" class="text-center"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Brak Serwerów!</h3>

                                    <?php else: ?>

                                        <table class="table table-hover table-striped table-responsive">
                                            <thead class="text-success text-center">
                                            <th class="text-center">Nazwa</th>
                                            <th class="text-center">Adres IP</th>
                                            <th class="text-center">Port</th>
                                            <th class="text-center">Port RCON</th>
                                            <th class="text-center">Hasło RCON</th>
                                            <th class="text-center"></th>
                                            </thead>
                                            <tbody>

                                            <?php foreach ($servers as $server): ?>

                                                <tr class="text-center">
                                                    <td><?php echo $server['name']; ?></td>
                                                    <td><?php echo $server['ip']; ?></td>
                                                    <td><?php echo $server['query_port']; ?></td>
                                                    <td><?php echo $server['rcon_port']; ?></td>
                                                    <td><?php echo $server['rcon_pass']; ?></td>
                                                    <td class="td-actions">

                                                        <?php echo form_open(base_url('panel/servers/edit')); ?>

                                                        <input type="hidden" name="serverId" value="<?php echo $server['id']; ?>">

                                                        <button type="submit" class="btn btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>

                                                        <?php echo form_close(); ?>


                                                        <?php echo form_open(base_url('panel/servers/remove')); ?>

                                                        <input type="hidden" name="serverId" value="<?php echo $server['id']; ?>">

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
                                    <h4 style="margin-bottom: 0; margin-top: 0;" class="title"><i class="fa fa-plus-square" aria-hidden="true"></i> Dodaj serwer</h4>
                                </div>
                                <div class="card-content">

                                    <?php echo form_open(base_url('panel/servers/create')); ?>

                                    <div class="col-lg-6 col-md-12 col-xs-12 text-center">
                                        <div class="form-group label-floating is-empty text-left">
                                            <label class="control-label">Nazwa serwera</label>
                                            <input type="text" name="serverName" class="form-control" required>
                                            <span class="material-input"></span>
                                        </div>
                                        <div class="form-group label-floating is-empty text-left">
                                            <label class="control-label">Adres IP serwera</label>
                                            <input type="text" name="serverIp" class="form-control" required>
                                            <span class="material-input"></span>
                                        </div>
                                        <div class="form-group label-floating is-empty text-left">
                                            <label class="control-label">Port serwera</label>
                                            <input type="text" name="serverQueryPort" class="form-control" required>
                                            <span class="material-input"></span>
                                        </div>
                                        <div class="form-group label-floating is-empty text-left">
                                            <label class="control-label">Port RCON serwera</label>
                                            <input type="text" name="serverRconPort" class="form-control" required>
                                            <span class="material-input"></span>
                                        </div>
                                        <div class="form-group label-floating is-empty text-left">
                                            <label class="control-label">Hasło RCON serwera</label>
                                            <input type="text" name="serverRconPass" class="form-control" required>
                                            <span class="material-input"></span>
                                        </div>
                                        <br />
                                        <button class="btn btn-success text-center"><i class="fa fa-plus-square" aria-hidden="true"></i>&nbsp;&nbsp;Dodaj serwer</button>
                                        <br />
                                        <br />
                                    </div>

                                    <?php echo form_close(); ?>

                                    <div class="col-lg-6 col-md-12 col-xs-12">
                                        <h6 style="text-transform: none; font-weight: bold;">Informacja:</h6>
                                        <p>
                                            Wszelkie dane potrzebne do uzupełnienia formularza obok znajdziesz w pliku <strong>"server.properties"</strong> w katalogu głównym serwera. Kolejno zaczynając od Adresu IP będą to linijki o nazwach: <strong>"server-ip"</strong>, <strong>"server-port"</strong>, <strong>"rcon.port"</strong> oraz <strong>"rcon.password"</strong>.
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>