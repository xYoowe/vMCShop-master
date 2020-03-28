<!--
 * Created with ♥ by Verlikylos on 08.10.2017 14:09.
 * Visit www.verlikylos.pro for more.
 * Copyright © vMCShop 2017
-->

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
                        <div class="col-lg-4 col-md-6 col-sm-12">

                            <div class="card">
                                <div class="card-content table-responsive">

                                    <?php if (!$pages): ?>

                                        <h3 style="margin-bottom: 20px;" class="text-center"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Brak Użytkowników!</h3>

                                    <?php else: ?>

                                        <table class="table table-hover table-striped table-responsive">
                                            <thead class="text-success text-center">
                                                <th class="text-center">Typ</th>
                                                <th class="text-center">Tytuł</th>
                                                <th class="text-center">Ikona</th>
                                                <th class="text-center">Zawartość strony/Odnośnik</th>
                                                <th class="text-center">Aktywne</th>
                                                <th class="text-center"></th>
                                            </thead>
                                            <tbody>

                                                <?php foreach ($pages as $page): ?>

                                                    <tr class="text-center">
                                                        <td><?php echo (($page['link'] == 1) || ($page['link'] == true)) ? "<span class='label label-warning'>Odnośnik</span>" : "<span class='label label-info'>Strona</span>" ?></td>
                                                        <td><?php echo $page['title']; ?></td>
                                                        <td><?php echo ((isset($page['icon'])) && ($page['icon'] != null)) ? '<i class="fa ' . $page['icon'] . ' fa-2x" aria-hidden="true"></i>' : 'Brak'; ?></td>
                                                        <td><?php echo (($page['link'] == 1) || ($page['link'] == true)) ? '<a class="link-reverse" href="' . $page['content'] . '">Przejdź</a>' : '<button class="btn btn-xs btn-info" style="margin: 0;" data-toggle="modal" data-target="#page' . $page['id'] . '"><i class="fa fa-search" aria-hidden="true"></i> Podgląd</button>' ?></td>
                                                        <td>

                                                            <?php echo form_open(base_url('panel/pages/changeStatus')); ?>

                                                            <input type="hidden" name="pageId" value="<?php echo $page['id']; ?>" />

                                                            <div class="togglebutton">

                                                                <label>
                                                                    <input type="checkbox" name="pageStatus" onChange="this.form.submit()" <?php echo (($page['active'] == true) || ($page['active'] == 1)) ? 'checked' : ''; ?>>
                                                                </label>

                                                            </div>

                                                            <?php echo form_close(); ?>

                                                        </td>
                                                        <td class="td-actions">

                                                            <?php echo form_open(base_url('panel/pages/edit')); ?>

                                                            <input type="hidden" name="pageId" value="<?php echo $page['id']; ?>">

                                                            <button type="submit" class="btn btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>

                                                            <?php echo form_close(); ?>


                                                            <?php echo form_open(base_url('panel/pages/remove')); ?>

                                                            <input type="hidden" name="pageId" value="<?php echo $page['id']; ?>">

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
                        <div class="col-lg-8 col-md-6 col-sm-12">

                            <div class="card">
                                <div class="card-header" data-background-color="primary">
                                    <h4 style="margin-bottom: 0; margin-top: 0;" class="title"><i class="fa fa-plus-square" aria-hidden="true"></i> Dodaj stronę</h4>
                                </div>
                                <div class="card-content">

                                    <?php echo form_open(base_url('panel/pages/create')); ?>

                                    <div class="col-xs-12 text-center">
                                        <div class="form-group label-floating text-left">
                                            <label class="control-label">Tytuł strony</label>
                                            <input type="text" name="pageTitle" class="form-control" required>
                                        </div>
                                        <br />
                                        <div class="checkbox">
                                            <label style="color: black;">
                                                <input type="checkbox" name="pageLink">
                                                Tylko odnośnik <small>(Jeżeli chcesz, aby przycisk przekierowywał na wybrany adres URL to zaznacz to pole, a docelowy link wklej w polu "Zawartość strony".)</small>
                                            </label>
                                        </div>
                                        <br />
                                        <div class="form-group label-floating text-left">
                                            <label class="control-label">Ikona</label>
                                            <input type="text" name="pageIcon" class="form-control" aria-describedby="iconHelp">
                                            <small id="iconHelp" class="form-text text-muted">Tutaj mozesz wpisać klasę ikony FontAwesome. Będzie się ona wyświetlać obok tytułu strony w nawigacji oraz na samej stronie. Przykład: "fa-adress-book". Listę dostępnych ikon możesz znaleźć <a href="http://fontawesome.io/icons/" class="link-reverse">tutaj</a>. Ikona nie jest wymagana.</small>
                                        </div>
                                        <br />
                                        <div class="form-group text-left">
                                            <label>Zawartość strony</label>
                                            <textarea id="pageContent" name="pageContent" rows="30" class="form-control"></textarea>
                                            <span class="material-input"></span>
                                        </div>
                                        <br />
                                        <br />
                                        <button class="btn btn-success text-center"><i class="fa fa-plus-square" aria-hidden="true"></i>&nbsp;&nbsp;Dodaj stronę</button>
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
