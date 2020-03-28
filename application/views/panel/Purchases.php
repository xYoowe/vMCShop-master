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

                                    <?php if (!$purchases): ?>

                                        <h3 style="margin-bottom: 20px;" class="text-center"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Nikt nie dokonał jeszcze zakupu!</h3>

                                    <?php else: ?>

                                        <table class="table table-hover table-striped table-responsive">
                                            <thead class="text-success text-center">
                                            <th class="text-center">Kupujący</th>
                                            <th class="text-center">Serwer</th>
                                            <th class="text-center">Usługa</th>
                                            <th class="text-center">Metoda Płatności</th>
                                            <th class="text-center">Szczegóły</th>
                                            <th class="text-center">Zysk</th>
                                            <th class="text-center">Data</th>
                                            </thead>
                                            <tbody>

                                            <?php foreach ($purchases as $purchase): ?>

                                                <tr class="text-center">
                                                    <td><?php echo $purchase['buyer']; ?></td>
                                                    <td><?php echo $purchase['server']; ?></td>
                                                    <td><?php echo $purchase['service']; ?></td>
                                                    <td><?php echo $purchase['method']; ?></td>
                                                    <td><?php echo $purchase['info']; ?></td>
                                                    <td><?php echo number_format(round($purchase['profit'], 2), 2, ',', ' '); ?> zł</td>
                                                    <td><?php echo formatDate($purchase['date']); ?></td>
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