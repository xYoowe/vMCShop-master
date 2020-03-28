<body>
    <div class="wrapper">

        <?php $this->load->view('panel/components/Sidebar'); ?>

        <div class="main-panel">
            <?php $this->load->view('panel/components/Navigation'); ?>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <?php if (isset($_SESSION['newUserInfo'])): ?>
                            <div class="col-xs-12">
                                <div class="alert alert-info text-left">
                                    <div class="container-fluid">
                                        <div class="alert-icon">
                                            <i class="material-icons">info_outline</i>
                                        </div>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        </button>
                                        <?php echo $_SESSION['newUserInfo']; ?>
                                    </div>
                                </div>
                            </div>
                            <?php unset($_SESSION['newUserInfo']); ?>
                        <?php endif; ?>
                        <div class="col-lg-7 col-md-6 col-sm-12">

                            <div class="card">
                                <div class="card-content table-responsive">
                                    <?php if (!$users): ?>

                                        <h3 style="margin-bottom: 20px;" class="text-center"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Brak Użytkowników!</h3>

                                    <?php else: ?>

                                        <table class="table table-hover table-striped table-responsive">
                                            <thead class="text-success text-center">
                                                <th class="text-center">Nazwa</th>
                                                <th class="text-center">Ostatnie IP</th>
                                                <th class="text-center">Ostatnie logowanie</th>
                                                <th class="text-center"></th>
                                            </thead>
                                            <tbody>

                                                <?php foreach ($users as $user): ?>

                                                    <tr class="text-center">
                                                        <td><?php echo $user['name']; ?></td>
                                                        <td><?php echo ($user['lastIP']) ? $user['lastIP'] : "Brak"; ?></td>
                                                        <td><?php echo ($user['lastLogin']) ? formatDate($user['lastLogin']) : 'Brak'; ?></td>
                                                        <td class="td-actions">

                                                            <?php if ($_SESSION['name'] != $user['name']): ?>

                                                                <?php echo form_open(base_url('panel/users/remove')); ?>

                                                                <input type="hidden" name="userId" value="<?php echo $user['id']; ?>">

                                                                <button type="submit" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></button>

                                                                <?php echo form_close(); ?>

                                                            <?php endif; ?>

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
                                    <h4 style="margin-bottom: 0; margin-top: 0;" class="title"><i class="fa fa-plus-square" aria-hidden="true"></i> Dodaj użytkownika</h4>
                                </div>
                                <div class="card-content">

                                    <?php echo form_open(base_url('panel/users/create')); ?>

                                        <div class="col-lg-8 col-md-12 col-xs-12 text-center">
                                            <div class="form-group label-floating is-empty text-left">
                                                <label class="control-label">Nazwa użytkownika</label>
                                                <input type="text" name="userName" class="form-control" required>
                                                <span class="material-input"></span>
                                            </div>
                                            <br />
                                            <button class="btn btn-success text-center"><i class="fa fa-plus-square" aria-hidden="true"></i>&nbsp;&nbsp;Dodaj użytkownika</button>
                                            <br />
                                            <br />
                                        </div>

                                    <?php echo form_close(); ?>

                                    <div class="col-lg-4 col-md-12 col-xs-12">
                                        <h6 style="text-transform: none; font-weight: bold;">Informacja:</h6>
                                        <p>
                                            Po dodaniu użytkownika zostanie wygenerowane losowe hasło, które wraz z wybraną nazwą użytkownika należy przesłać nowemu administratorowi.
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>