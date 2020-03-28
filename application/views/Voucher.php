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
                                <h3><i class="fa fa-key" aria-hidden="true"></i> Realizacja vouchera</h3>
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
                            <?php if (isset($_SESSION['messageSuccess'])): ?>
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
                                <?php unset($_SESSION['messageSuccess']); ?>
                            <?php endif; ?>
                            <?php echo form_open(base_url('voucher/redeem')); ?>
                            <div class="form-group label-floating text-left">
                                <label class="control-label">Podaj swój nick z serwera...</label>
                                <input type="text" name="userName" class="form-control" required />
                            </div>
                            <br />
                            <div class="form-group label-floating text-left">
                                <label class="control-label">Podaj kod vouchera...</label>
                                <input type="text" name="voucher" class="form-control" required />
                            </div>
                            <br />
                            <button type="submit" class="btn btn-success-o"><i class="fa fa-check" aria-hidden="true"></i> Realizuj voucher</button>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    </div>