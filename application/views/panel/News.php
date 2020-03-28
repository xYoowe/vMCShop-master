<body>
    <div class="wrapper">

        <?php $this->load->view('panel/components/Sidebar'); ?>

        <div class="main-panel">
            <?php $this->load->view('panel/components/Navigation'); ?>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-lg-4 col-xs-12">
                            <?php if (!$news): ?>

                                <div class="col-xs-12">
                                    <div class="card card-raised">
                                        <div class="card-body">
                                            <h3 class="text-center"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Brak aktualności!</h3>
                                        </div>
                                    </div>
                                </div>

                            <?php else: ?>

                                <?php foreach ($news as $newsUnit): ?>

                                    <div class="col-xs-12">
                                        <div class="card card-raised">
                                            <div class="card-image" style="margin-left: 0; margin-right: 0;">
                                                <img class="card" style="border-radius: 0; margin-bottom: 0;" src="<?php echo $newsUnit['image']; ?>" alt="<?php echo $newsUnit['title']; ?>" />
                                            </div>
                                            <div class="card-body" style="padding: 18px; padding-bottom: 0;">
                                                <h3 class="card-title" style="margin-top: 0; font-weight: bold;"><?php echo $newsUnit['title']; ?></h3>

                                                <p><?php echo $newsUnit['content']; ?></p>
                                                <hr style="margin-bottom: 0;" />
                                                    <?php echo form_open(base_url('panel/news/edit'), 'class="inline-form"'); ?>

                                                    <input type="hidden" name="newsId" value="<?php echo $newsUnit['id']; ?>">

                                                    <button type="submit" class="btn btn-info btn-action"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>

                                                    <?php echo form_close(); ?>


                                                    <?php echo form_open(base_url('panel/news/remove'), 'class="inline-form"'); ?>

                                                    <input type="hidden" name="newsId" value="<?php echo $newsUnit['id']; ?>">

                                                    <button type="submit" class="btn btn-action btn-danger"><i class="fa fa-times" aria-hidden="true"></i></button>

                                                    <?php echo form_close(); ?>
                                                <span class="pull-right" style="margin-top: 0.7em; margin-bottom: 0.7em;"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo formatDate($newsUnit['date']); ?></span>
                                            </div>
                                        </div>
                                    </div>

                                <?php endforeach; ?>

                            <?php endif; ?>
                        </div>

                        <div class="col-lg-8 col-sm-12">

                            <div class="card">
                                <div class="card-header" data-background-color="primary">
                                    <h4 style="margin-bottom: 0; margin-top: 0;" class="title"><i class="fa fa-plus-square" aria-hidden="true"></i> Dodaj news</h4>
                                </div>
                                <div class="card-content">

                                    <?php echo form_open_multipart(base_url('panel/news/create')); ?>

                                    <div class="col-xs-12 text-center">
                                        <div class="form-group label-floating text-left">
                                            <label class="control-label">Tytuł newsa</label>
                                            <input type="text" name="newsTitle" class="form-control" required>
                                        </div>
                                        <br />
                                        <div class="form-group text-left">
                                            <input type="file" id="newsImage" name="newsImage" style="cursor: pointer;" accept="image/*" required>
                                            <div class="input-group">
                                                    <span class="input-group-btn input-group-sm">
                                                        <button type="button" class="btn btn-success">
                                                            <i class="fa fa-upload" aria-hidden="true"></i>
                                                         </button>
                                                    </span>
                                                <input type="text" readonly="" class="form-control" placeholder="Wybierz obrazek...">
                                            </div>
                                        </div>
                                        <br />
                                        <div class="form-group text-left">
                                            <label>Treść newsa</label>
                                            <textarea id="newsContent" name="newsContent" rows="15" class="form-control"></textarea>
                                            <span class="material-input"></span>
                                        </div>
                                        <br />
                                        <br />
                                        <button class="btn btn-success text-center"><i class="fa fa-plus-square" aria-hidden="true"></i>&nbsp;&nbsp;Dodaj newsa</button>
                                        <br />
                                        <br />
                                    </div>

                                    <?php echo form_close(); ?>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>