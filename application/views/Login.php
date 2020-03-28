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
                        <div class="col-md-4 col-md-offset-4 text-center">
                            <div class="title text-center">
                                <h3><i class="fa fa-desktop" aria-hidden="true"></i> Logowanie do ACP</h3>
                            </div>
                            <br />
                            <?php if (isset($_SESSION['messageDanger'])): ?>
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
                                <?php unset($_SESSION['messageDanger']); ?>
                            <?php endif; ?>
                            <?php echo form_open(base_url('admin/login')); ?>
                                <div class="form-group label-floating text-left">
                                    <label class="control-label">Podaj login...</label>
                                    <input type="text" name="login" class="form-control" required autocomplete="off" />
                                </div>
                                <div class="form-group label-floating text-left">
                                    <label class="control-label">Podaj hasło...</label>
                                    <input type="password" name="pass" class="form-control" required autocomplete="off" />
                                </div>
                                <br />
                                <button type="submit" class="btn btn-success-o"><i class="fa fa-sign-in" aria-hidden="true"></i> Zaloguj się</button>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>