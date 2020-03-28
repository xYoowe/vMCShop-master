            <footer class="footer">
                <div class="container-fluid">
                    <nav class="pull-left">
                        <ul>
                            <li>
                                <a class="link-d-reverse" href="<?php echo base_url(); ?>">
                                    <i class="fa fa-home" aria-hidden="true"></i> Przejdź do sklepu
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <p class="copyright pull-right">
                        Proudly powered by <a class="link-d" href="https://verlikylos.pro/">vMCShop</a> v<?php echo $this->config->item('script_version'); ?>
                    </p>
                </div>
            </footer>
        </div>

        <?php if ($this->uri->rsegment('1') == "services"): ?>

            <!-- Services Modals -->
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
                                <div class="card card-nav-tabs">
                                    <div class="card-header" data-background-color="primary">
                                        <div class="nav-tabs-navigation">
                                            <div class="nav-tabs-wrapper">

                                                <ul class="nav nav-tabs nav-justified" data-tabs="tabs">

                                                        <li class="active">
                                                            <a href="#image<?php echo $service['id']; ?>" data-toggle="tab">
                                                                <i class="fa fa-picture-o" aria-hidden="true"></i> Obrazek
                                                                <div class="ripple-container"></div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#desc<?php echo $service['id']; ?>" data-toggle="tab">
                                                                <i class="fa fa-info" aria-hidden="true"></i> Opis
                                                                <div class="ripple-container"></div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#cmds<?php echo $service['id']; ?>" data-toggle="tab">
                                                                <i class="fa fa-terminal" aria-hidden="true"></i> Komendy
                                                                <div class="ripple-container"></div>
                                                            </a>
                                                        </li>

                                                </ul>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-content">
                                        <div class="tab-content">

                                            <div class="tab-pane active" id="image<?php echo $service['id']; ?>">
                                                <img src="<?php echo $service['image']; ?>" alt="<?php echo $service['name']; ?> image" />
                                            </div>
                                            <div class="tab-pane" id="desc<?php echo $service['id']; ?>">
                                                <?php echo $service['description']; ?>
                                            </div>
                                            <div class="tab-pane text-center" id="cmds<?php echo $service['id']; ?>">
                                                <?php
                                                $i = 0;
                                                $cmds = "<ul>";

                                                foreach ($service['commands'] as $command) {

                                                    if ($i == 0) {
                                                        $cmds = "<li>" . $command . "</li>";
                                                    } else {
                                                        $cmds = $cmds . "<li>" . $command . "</li>";
                                                    }

                                                    $i++;

                                                }

                                                echo $cmds . "</ul>";
                                                ?>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>

        <?php endif; ?>

        <?php if ($this->uri->rsegment('1') == "pages"): ?>

            <!-- Modals -->
            <?php foreach ($pages as $page): ?>

                <div class="modal fade" id="page<?php echo $page['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog" style="width: 90% !important;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    <i class="material-icons">clear</i>
                                </button>
                                <h4 class="modal-title"><?php echo ((isset($page['icon'])) && ($page['icon'] != null)) ? '<i class="fa ' . $page['icon'] . '" aria-hidden="true"></i>' : ''; ?> <?php echo $page['title']; ?></h4>
                                <hr />
                            </div>
                            <div class="modal-body">
                                <?php echo $page['content']; ?>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>

        <?php endif; ?>

        <script type="text/javascript" src="<?php echo base_url('assets/js/panel/jquery.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/panel/bootstrap.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/panel/material.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/panel/chartist.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/panel/bootstrap-notify.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/panel/material-dashboard.js'); ?>"></script>
        <script type="text/javascript" src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
        <!--<script type="text/javascript" src='https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=TWÓJ_KLUCZ_API'></script>-->
        <script type="text/javascript" src='<?php echo base_url('assets/js/jquery.select-bootstrap.js'); ?>'></script>
        <script type="text/javascript">
            $('.sidebar-wrapper').css('max-height', window.innerHeight-294);
            $('.content').css('min-height', window.innerHeight-155);

            <?php if ($this->uri->rsegment('1') == "services"): ?>
                tinymce.init({
                    selector: '#serviceDesc',
                    browser_spellcheck: true,
                    branding: false,
                    plugins: [
                        'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
                        'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                        'save table contextmenu directionality emoticons template paste textcolor'
                    ],
                    menubar: '',
                    toolbar: 'undo redo | format | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent link | fullscreen preview'
                });
            <?php endif; ?>

            <?php if ($this->uri->rsegment('1') == "pages"): ?>
            tinymce.init({
                selector: '#pageContent',
                browser_spellcheck: true,
                branding: false,
                plugins: [
                    'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
                    'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                    'save table contextmenu directionality emoticons template paste textcolor'
                ],
                menubar: '',
                toolbar: 'undo redo | format | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent link | fullscreen preview'
            });
            <?php endif; ?>

            <?php if ($this->uri->rsegment('1') == "news"): ?>
            tinymce.init({
                selector: '#newsContent',
                browser_spellcheck: true,
                branding: false,
                plugins: [
                    'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
                    'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                    'save table contextmenu directionality emoticons template paste textcolor'
                ],
                menubar: '',
                toolbar: 'undo redo | format | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent link | fullscreen preview'
            });
            <?php endif; ?>

            <?php if ((isset($_SESSION['messageSuccess'])) && ($_SESSION['messageSuccess'] != "")): ?>
                window.onload = function () {

                    $.notify({
                        icon: "check",
                        message: "<?php echo $_SESSION['messageSuccess']; ?>"

                    },{
                        type: 'success',
                        timer: 2000,
                        placement: {
                            from: 'top',
                            align: 'right'
                        }
                    });

                }
            <?php endif; ?>
            <?php unset($_SESSION['messageSuccess']); ?>

            <?php if ((isset($_SESSION['messageDanger'])) && ($_SESSION['messageDanger'] != "")): ?>
                window.onload = function () {

                    $.notify({
                        icon: "warning",
                        message: "<?php echo $_SESSION['messageDanger']; ?>"

                    },{
                        type: 'danger',
                        timer: 2000,
                        placement: {
                            from: 'top',
                            align: 'right'
                        }
                    });

                }
            <?php endif; ?>
            <?php unset($_SESSION['messageDanger']); ?>

            <?php if ($this->uri->rsegment('1') == "dashboard"): ?>

                $(document).ready(function(){
                    demo.initDashboardPageCharts();
                });

                demo = {
                    initDashboardPageCharts: function() {

                        dataWeekPurchases = {
                            labels: ['Pon', 'Wt', 'Śr', 'Czw', 'Pt', 'Sob', 'Niedz'],
                            series: [
                                [<?php echo $chartValues; ?>]
                            ]
                        };

                        optionsWeekPurchases = {
                            lineSmooth: Chartist.Interpolation.cardinal({
                                tension: 0
                            }),
                            height: 150,
                            onlyInteger: true,
                            low: 0,
                            high: <?php echo $chartHigest; ?>,
                            chartPadding: {top: 20, right: 20, bottom: -12, left: -10},
                        }

                        var weekPurchases = new Chartist.Line('#weekPurchases', dataWeekPurchases, optionsWeekPurchases);

                        md.startAnimationForLineChart(weekPurchases);

                    }
                };

            <?php endif; ?>

        </script>
    </body>
</html>
