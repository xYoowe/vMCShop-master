<body>
    <div class="wrapper">

        <?php $this->load->view('panel/components/Sidebar'); ?>

        <div class="main-panel">
            <?php $this->load->view('panel/components/Navigation'); ?>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-xs-12">

                            <div class="card">
                                <div class="card-content">
                                    <?php if (!$logs): ?>

                                        <h3 style="margin-bottom: 20px;" class="text-center"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Brak Logów!</h3>

                                    <?php else: ?>

                                        <table class="table table-hover table-striped table-responsive">
                                            <thead class="text-success text-center">
                                                <th class="text-center">Użytkownik</th>
                                                <th class="text-center">Sekcja</th>
                                                <th class="text-center">Szczegóły</th>
                                                <th class="text-center">Data</th>
                                            </thead>
                                            <tbody>

                                                <?php foreach ($logs as $log): ?>

                                                    <tr class="text-center">
                                                        <td><?php echo $log['user']; ?></td>
                                                        <td><?php echo $log['section']; ?></td>
                                                        <td><?php echo ($log['section'] == "Logowanie") ? "Zalogowano z adresu IP " . $log['details'] : $log['details']; ?></td>
                                                        <td><?php echo formatDate($log['date']); ?></td>
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