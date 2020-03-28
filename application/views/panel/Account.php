<body>
    <div class="wrapper">

        <?php $this->load->view('panel/components/Sidebar'); ?>

        <div class="main-panel">
            <?php $this->load->view('panel/components/Navigation'); ?>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <div class="card card-profile">
                                <div class="card-avatar">
                                    <img class="img-circle img-raised" src="<?php echo $_SESSION['avatar']; ?>" alt="<?php echo $_SESSION['name']; ?> avatar" />
                                </div>
                                <div class="content" style="height: 23em;">
                                    <h4 class="card-title"><?php echo $_SESSION['name']; ?></h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-8">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="card">
                                            <div class="card-header" data-background-color="primary">
                                                <h4 class="card-title">
                                                    <i class="fa fa-key" aria-hidden="true"></i> Zmień hasło
                                                </h4>
                                            </div>
                                            <div class="card-content">
                                                <?php echo form_open(base_url('panel/account/changePassword')); ?>

                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Podaj aktualne hasło...</label>
                                                        <input type="password" name="pass1" class="form-control" required>
                                                    </div>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Podaj nowe hasło...</label>
                                                        <input type="password" name="pass2" class="form-control" required>
                                                    </div>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Powtórz nowe hasło...</label>
                                                        <input type="password" name="pass3" class="form-control" required>
                                                    </div>
                                                    <div class="form-group text-center">
                                                        <button class="btn btn-success btn-lg"><i class="fa fa-check" aria-hidden="true"></i> Akceptuj<div class="ripple-container"></div></button>
                                                    </div>

                                                <?php echo form_close(); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="card">
                                            <div class="card-header" data-background-color="primary">
                                                <h4 class="card-title">
                                                    <i class="fa fa-user" aria-hidden="true"></i> Zmiań avatar
                                                </h4>
                                            </div>
                                            <div class="card-content">
                                                <?php echo form_open_multipart(base_url('panel/account/changeAvatar')); ?>

                                                    <div class="form-group text-left">
                                                        <input type="file" id="avfile" name="avfile" style="cursor: pointer;" accept="image/*" required>
                                                        <div class="input-group">
                                                        <span class="input-group-btn input-group-sm">
                                                            <button type="button" class="btn btn-success">
                                                                <i class="fa fa-upload" aria-hidden="true"></i>
                                                             </button>
                                                        </span>
                                                            <input type="text" readonly="" class="form-control" placeholder="Wybierz plik z avatarem...">
                                                        </div>
                                                    </div>
                                                    <div class="form-group text-center">
                                                        <button class="btn btn-success btn-lg"><i class="fa fa-check" aria-hidden="true"></i> Akceptuj<div class="ripple-container"></div></button>
                                                    </div>

                                                <?php echo form_close(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>