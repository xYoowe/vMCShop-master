<!--
 * Created with ♥ by Verlikylos on 08.10.2017 17:52.
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
                        <div class="col-sm-12">
                            <div class="title">
                                <h3><?php echo ((isset($page['icon'])) && ($page['icon'] != null)) ? '<i class="fa ' . $page['icon'] . '" aria-hidden="true"></i>' : ''; ?> <?php echo $page['title']; ?></h3>
                            </div>
                            <hr />
                            <br />
                            <div id="pageContent">
                                <?php echo $page['content']; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>