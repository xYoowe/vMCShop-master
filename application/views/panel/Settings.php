<body>
    <div class="wrapper">

        <?php $this->load->view('panel/components/Sidebar'); ?>

        <div class="main-panel">
            <?php $this->load->view('panel/components/Navigation'); ?>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-xs-12">

                            <?php echo form_open(base_url('panel/settings/save')); ?>

                            <div class="card">
                                <div class="card-content">
                                    <h2 class="text-center" style="margin-top: 0;"><i class="fa fa-wrench" aria-hidden="true"></i> Ustawienia Strony</h2>
                                    <div class="container">

                                        <hr />

                                        <div class="row">

                                            <div class="col-md-6 col-xs-12">

                                                <div class="form-group label-floating text-left">
                                                    <label class="control-label">Tytuł strony</label>
                                                    <input type="text" name="pageTitle" value="<?php echo $this->config->item('page_title'); ?>" class="form-control" required>
                                                </div>

                                            </div>

                                            <div class="col-md-6 col-xs-12">
                                                Tytuł strony używany w tagu <code>&lt;title&gt;</code>. Pojawia się w nazwie karty przeglądarki.
                                            </div>

                                        </div>

                                        <br /><hr /><br />

                                        <div class="row">

                                            <div class="col-md-6 col-xs-12">

                                                <div class="form-group label-floating is-empty text-left">
                                                    <label class="control-label">Opis strony</label>
                                                    <textarea name="pageDescription" class="form-control" rows="5"><?php echo $this->config->item('page_description'); ?></textarea>
                                                    <span class="material-input"></span>
                                                </div>

                                            </div>

                                            <div class="col-md-6 col-xs-12">
                                                Opis strony wyświetlany przez wyszukiwarki internetowe.
                                            </div>

                                        </div>

                                        <br /><hr /><br />

                                        <div class="row">

                                            <div class="col-md-6 col-xs-12">

                                                <div class="form-group label-floating text-left">
                                                    <label class="control-label">Tagi strony</label>
                                                    <input type="text" name="pageTags" value="<?php echo $this->config->item('page_tags'); ?>" class="form-control">
                                                </div>

                                            </div>

                                            <div class="col-md-6 col-xs-12">
                                                Tagi strony pozycjonujące ją w wyszukiwarce internetowej oddzielone przecinkami.
                                            </div>

                                        </div>

                                        <br /><hr /><br />

                                        <div class="row">

                                            <div class="col-md-6 col-xs-12">

                                                <div class="form-group label-floating text-left">
                                                    <label class="control-label">Ikona ulubionych strony</label>
                                                    <input type="text" name="pageFavicon" value="<?php echo $this->config->item('page_favicon'); ?>" class="form-control">
                                                </div>

                                            </div>

                                            <div class="col-md-6 col-xs-12">
                                                Link do ikony o wymiarach 16x16 pixeli. Wyświetlana ona jest obok nazwy karty przeglądarki.
                                            </div>

                                        </div>

                                        <br /><hr /><br />

                                        <div class="row">

                                            <div class="col-md-6 col-xs-12">

                                                <div class="form-group label-floating text-left">
                                                    <label class="control-label">Obrazek nagłówka strony</label>
                                                    <input type="text" name="pageHeaderImage" value="<?php echo $this->config->item('page_header_image'); ?>" class="form-control" required>
                                                </div>

                                            </div>

                                            <div class="col-md-6 col-xs-12">
                                                Link do tła nagłówka wyświetlanego na stronie głównej, w zakładce sklepu oraz w zakładce realizacji voucheru.
                                            </div>

                                        </div>

                                        <br /><hr /><br />

                                        <div class="row">

                                            <div class="col-md-6 col-xs-12">

                                                <div class="form-group label-floating text-left">
                                                    <label class="control-label">Tytuł nagłówka strony</label>
                                                    <input type="text" name="pageHeaderTitle" value="<?php echo $this->config->item('page_header_title'); ?>" class="form-control" required>
                                                </div>

                                            </div>

                                            <div class="col-md-6 col-xs-12">
                                                Tekst wyświetlany w nagłówku strony. Aby umieścić logo swojego serwera należy użyć znacznika <code>&lt;img&gt;</code>.
                                            </div>

                                        </div>

                                        <br /><hr /><br />

                                        <div class="row">

                                            <div class="col-md-6 col-xs-12">

                                                <div class="form-group label-floating text-left">
                                                    <label class="control-label">Podtytuł nagłówka strony</label>
                                                    <input type="text" name="pageHeaderSubtitle" value="<?php echo $this->config->item('page_header_subtitle'); ?>" class="form-control">
                                                </div>

                                            </div>

                                            <div class="col-md-6 col-xs-12">
                                                Mniejszy tekst wyświetlany w nałówku strony. Można całkowicie z niego zrezygnować pozostawiając to pole puste.
                                            </div>

                                        </div>

                                        <br /><br />

                                    </div>
                                </div>
                            </div>


                            <!-- Payments -->

                            <div class="card">
                                <div class="card-content">
                                    <h2 class="text-center" style="margin-top: 0;"><i class="fa fa-credit-card" aria-hidden="true"></i> Ustawienia Płatności</h2>
                                    <div class="container">

                                        <hr /><br />

                                        <div class="row">

                                            <div class="col-md-6 col-xs-12">

                                                <div class="btn-group bootstrap-select">
                                                    <select name="smsOperator" class="selectpicker" data-style="select-with-transition" title="Operator płatności SMS" data-size="7" tabindex="-98" required>
                                                        <option disabled=""> Operator płatności SMS</option>
                                                        <option value="MicroSMS" <?php echo ($this->config->item('sms_operator') == "MicroSMS") ? "selected" : ""; ?>>MicroSMS.pl</option>
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="col-md-6 col-xs-12">
                                                Operator płatności SMS.
                                            </div>

                                        </div>

                                        <br /><br /><hr /><br />

                                        <div class="row">

                                            <div class="col-md-6 col-xs-12">

                                                <div class="form-group label-floating text-left">
                                                    <label class="control-label">ID użytkownika MicroSMS.pl</label>
                                                    <input type="text" name="microsmsUserid" value="<?php echo $this->config->item('microsms_userid'); ?>" class="form-control" required>
                                                </div>

                                            </div>

                                            <div class="col-md-6 col-xs-12">
                                                ID użytkownika w serwisie MicroSMS.pl<br /><br />
                                                <img class="img-responsive" style="width: 50%" src="<?php echo base_url('assets/images/microsms_userid.png'); ?>" alt="microsms userid" />
                                            </div>

                                        </div>

                                        <br /><br />

                                    </div>
                                </div>
                            </div>


                            <!-- Others -->

                            <div class="card">
                                <div class="card-content">
                                    <h2 class="text-center" style="margin-top: 0;"><i class="fa fa-sliders" aria-hidden="true"></i> Ustawienia Ogólne</h2>
                                    <div class="container">

                                        <hr />

                                        <div class="row">

                                            <div class="col-md-6 col-xs-12">

                                                <div class="form-group label-floating text-left">
                                                    <label class="control-label">Prefix vouchera</label>
                                                    <input type="text" name="voucherPrefix" value="<?php echo $this->config->item('voucher_prefix'); ?>" class="form-control">
                                                </div>

                                            </div>

                                            <div class="col-md-6 col-xs-12">
                                                Tekst pojawiający się przed wygenerowanym kodem vouchera. Można w ten sposób stworzyć np. vouchery z nazwą serwera w ich kodzie. Przykład: <strong>vMCShop_</strong>YOtSTvsVEkeCJcogiBrGWNulAwZdQKxDXUjRapFLhqPIymnf
                                            </div>

                                        </div>

                                        <br /><hr /><br />

                                        <div class="row">

                                            <div class="col-md-6 col-xs-12">

                                                <div class="form-group label-floating text-left">
                                                    <label class="control-label">Długość kodu vouchera</label>
                                                    <input type="text" name="voucherLenght" value="<?php echo $this->config->item('voucher_lenght'); ?>" class="form-control" required>
                                                </div>

                                            </div>

                                            <div class="col-md-6 col-xs-12">
                                                Parametr ten określa ilość losowych liter kodu vouchera.
                                            </div>

                                        </div>

                                        <br /><br />

                                    </div>
                                </div>
                            </div>


                            <!-- Buttons -->

                            <div class="card">
                                <div class="card-content">
                                    <div class="container text-center">
                                        <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-floppy-o" aria-hidden="true"></i> Zapisz ustawienia</button>
                                        <button class="btn btn-danger btn-lg"><i class="fa fa-trash-o" aria-hidden="true"></i> Reinstaluj sklep</button>
                                    </div>
                                </div>
                            </div>

                            <?php echo form_close(); ?>

                        </div>

                    </div>
                </div>
            </div>