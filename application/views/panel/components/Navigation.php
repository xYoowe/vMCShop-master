<nav class="navbar navbar-transparent">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php if ($this->uri->rsegment('1') == "dashboard") echo '<a class="navbar-brand" href="#"><i class="fa fa-desktop" aria-hidden="true"></i> Dashboard</a>'; ?>
            <?php if ($this->uri->rsegment('1') == "account") echo '<a class="navbar-brand" href="#"><i class="fa fa-user" aria-hidden="true"></i> Ustawienia Konta</a>'; ?>
            <?php if ($this->uri->rsegment('1') == "users") echo '<a class="navbar-brand" href="#"><i class="fa fa-users" aria-hidden="true"></i> Użytkownicy ACP</a>'; ?>
            <?php if ($this->uri->rsegment('1') == "servers") echo '<a class="navbar-brand" href="#"><i class="fa fa-server" aria-hidden="true"></i> Serwery</a>'; ?>
            <?php if ($this->uri->rsegment('1') == "services") echo '<a class="navbar-brand" href="#"><i class="fa fa-diamond" aria-hidden="true"></i> Usługi</a>'; ?>
            <?php if ($this->uri->rsegment('1') == "news") echo '<a class="navbar-brand" href="#"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Newsy</a>'; ?>
            <?php if ($this->uri->rsegment('1') == "purchases") echo '<a class="navbar-brand" href="#"><i class="fa fa-history" aria-hidden="true"></i> Historia zakupów</a>'; ?>
            <?php if ($this->uri->rsegment('1') == "vouchers") echo '<a class="navbar-brand" href="#"><i class="fa fa-key" aria-hidden="true"></i> Vouchery</a>'; ?>
            <?php if ($this->uri->rsegment('1') == "pages") echo '<a class="navbar-brand" href="#"><i class="fa fa-file-code-o" aria-hidden="true"></i> Własne strony</a>'; ?>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li data-toggle="tooltip" data-placement="bottom" title="Ustawienia konta">
                    <a href="<?php echo base_url('panel/account'); ?>">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <p class="hidden-lg hidden-md">Ustawienie konta</p>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url('admin/logout'); ?>">
                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                        <p class="hidden-lg hidden-md">Wyloguj się</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>