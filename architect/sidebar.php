<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.php" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="<?= logo_url ?>" style="width:100px;">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2" style="color:#fff;">tenant</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item <?= $page == "dashboard" ? "active" : "" ?>">
            <a href="index.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>

        <li class="menu-item <?= $page == "property" ? "active" : "" ?>">
            <a href="view_properties" class="menu-link">
                <i class="menu-icon fa-solid fa-umbrella"></i>
                <div data-i18n="Properties">Properties</div>
            </a>
        </li>
        <li class="menu-item <?= $page == "projects" ? "active" : "" ?>">
            <a href="view_projects" class="menu-link">
                <i class="menu-icon bx bx-building-house"></i>
                <div class="MySide" data-i18n="Projects">Projects</div>
            </a>
        </li>
   
        
        
         <li class="menu-item <?= $page == "payment" ? "active" : "" ?>">
            <a href="view_payments" class="menu-link">
                <i class="menu-icon fa-solid fa-user-group"></i>
                <div data-i18n="Rent Payments">Rent Payments</div>
            </a>
        </li>
        
         <li class="menu-item <?= $page == "history" ? "active" : "" ?>">
            <a href="view_history" class="menu-link">
                <i class="menu-icon fa-solid fa-user-group"></i>
                <div data-i18n="Living History">Living History</div>
            </a>
        </li>

        <!--<li class="menu-item">-->
        <!--    <a href="view_invoices" class="menu-link">-->
        <!--        <i class="menu-icon fa-solid fa-receipt"></i>-->
        <!--        <div data-i18n="Invoices">Invoices</div>-->
        <!--    </a>-->
        <!--</li>-->
        <li class="menu-item <?= $page == "projects" ? "active" : "" ?>">
            <a href="my-projects" class="menu-link ">
                <i class="menu-icon bx bx-user"></i>
                <div data-i18n="My Projects">My Projects</div>
            </a>
        </li>
        
        <li class="menu-item <?= $page == "profile" ? "active" : "" ?>">
            <a href="profile" class="menu-link ">
                <i class="menu-icon bx bx-user"></i>
                <div data-i18n="My Profile">My Profile</div>
            </a>
        </li>


        <li class="menu-item <?= $page == "password" ? "active" : "" ?>">
            <a href="password" class="menu-link ">
                <i class="menu-icon bx bx-low-vision"></i>
                <div data-i18n="Change Password">Change Password</div>
            </a>
        </li>



        <li class="menu-item">
            <a href="?logout" class="menu-link">
                <i class="menu-icon fa-solid fa-right-from-bracket"></i>
                <div data-i18n="Logout">Logout</div>
            </a>
        </li>

    </ul>
</aside>