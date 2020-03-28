<div class="sidebar" data-color="purple" data-image="<?php echo base_url('assets/images/geometry.png'); ?>" style="max-width: 260px;">

    <div class="logo">
        <div class="logo-container text-center">
            <div class="logo-tim center-block">
                <img src="<?php echo $_SESSION['avatar']; ?>" />
            </div>
            <h6 style="text-transform: none;" class="text-primary">Witaj, <?php echo $_SESSION['name']; ?>!<br />Admin Control Panel</h6>
        </div>
    </div>

    <div class="sidebar-wrapper">
        <ul class="nav">
            <li <?php echo ($this->uri->rsegment('1') == "dashboard") ? 'class="active"' : ''; ?>>
                <a <?php echo ($this->uri->rsegment('1') == "dashboard") ? 'href="#"' : 'href="'.base_url("panel/dashboard").'"'; ?>>
                    <i class="fa fa-desktop" aria-hidden="true"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li <?php echo ($this->uri->rsegment('1') == "users") ? 'class="active"' : ''; ?>>
                <a <?php echo ($this->uri->rsegment('1') == "users") ? 'href="#"' : 'href="'.base_url("panel/users").'"'; ?>>
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <p>Użytkownicy ACP</p>
                </a>
            </li>
            <li <?php echo ($this->uri->rsegment('1') == "servers") ? 'class="active"' : ''; ?>>
                <a <?php echo ($this->uri->rsegment('1') == "servers") ? 'href="#"' : 'href="'.base_url("panel/servers").'"'; ?>>
                    <i class="fa fa-server" aria-hidden="true"></i>
                    <p>Serwery</p>
                </a>
            </li>
            <li <?php echo ($this->uri->rsegment('1') == "services") ? 'class="active"' : ''; ?>>
                <a <?php echo ($this->uri->rsegment('1') == "services") ? 'href="#"' : 'href="'.base_url("panel/services").'"'; ?>>
                    <i class="fa fa-diamond" aria-hidden="true"></i>
                    <p>Usługi</p>
                </a>
            </li>
            <li <?php echo ($this->uri->rsegment('1') == "news") ? 'class="active"' : ''; ?>>
                <a <?php echo ($this->uri->rsegment('1') == "news") ? 'href="#"' : 'href="'.base_url("panel/news").'"'; ?>>
                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                    <p>Newsy</p>
                </a>
            </li>
            <li <?php echo ($this->uri->rsegment('1') == "vouchers") ? 'class="active"' : ''; ?>>
                <a <?php echo ($this->uri->rsegment('1') == "vouchers") ? 'href="#"' : 'href="'.base_url("panel/vouchers").'"'; ?>>
                    <i class="fa fa-key" aria-hidden="true"></i>
                    <p>Vouchery</p>
                </a>
            </li>
            <li <?php echo ($this->uri->rsegment('1') == "pages") ? 'class="active"' : ''; ?>>
                <a <?php echo ($this->uri->rsegment('1') == "pages") ? 'href="#"' : 'href="'.base_url("panel/pages").'"'; ?>>
                    <i class="fa fa-file-code-o" aria-hidden="true"></i>
                    <p>Własne strony</p>
                </a>
            </li>

            <li>
                &nbsp;
            </li>

            <li <?php echo ($this->uri->rsegment('1') == "purchases") ? 'class="active"' : ''; ?>>
                <a <?php echo ($this->uri->rsegment('1') == "purchases") ? 'href="#"' : 'href="'.base_url("panel/purchases").'"'; ?>>
                    <i class="fa fa-history" aria-hidden="true"></i>
                    <p>Historia zakupów</p>
                </a>
            </li>
            <li <?php echo ($this->uri->rsegment('1') == "logs") ? 'class="active"' : ''; ?>>
                <a <?php echo ($this->uri->rsegment('1') == "logs") ? 'href="#"' : 'href="'.base_url("panel/logs").'"'; ?>>
                    <i class="fa fa-database" aria-hidden="true"></i>
                    <p>Logi</p>
                </a>
            </li>
        </ul>
    </div>
</div>