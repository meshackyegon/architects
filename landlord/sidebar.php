<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.php" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="<?= logo_url ?>" style="width:100px;">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2" style="color:#fff;">agent</span>
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

        <?php
        if ($profile['landlord_status'] == 'active') { ?>

            <li class="menu-header small text-uppercase"><span class="menu-header-text">Property Info</span></li>

            <li class="menu-item <?= $page == "property" ? "active" : "" ?>">
                <a href="view_properties" class="menu-link">
                    <i class="menu-icon bx bx-building-house"></i>
                    <div data-i18n="Properties">Properties</div>
                </a>
            </li>


            <li class="menu-item  <?= $page == "users" ? "active" : "" ?>">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon bx bx-user-pin"></i>
                    <div data-i18n="Tenants">Tenants</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="view_users?current" class="menu-link">
                            <div data-i18n="Current">Current</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="view_users?former" class="menu-link">
                            <div data-i18n="Former">Former</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="view_requests" class="menu-link">
                            <div data-i18n="Requested">Requested</div>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="menu-item <?= $page == "payment" ? "active" : "" ?>">
                <a href="view_payments" class="menu-link ">
                    <i class="menu-icon bx bxs-dollar-circle"></i>
                    <div data-i18n="View Payments">View Payments</div>
                </a>
            </li>



            <li class="menu-header small text-uppercase"><span class="menu-header-text">Reports</span></li>

            <li class="menu-item  <?= $page == "reports" ? "active" : "" ?>">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon bx bxs-wallet"></i>
                    <div data-i18n="Tenant Reports">Tenant Reports</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="view_users?current" class="menu-link">
                            <div data-i18n="Current">Current</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="view_users?former" class="menu-link">
                            <div data-i18n="Former">Former</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="view_requests" class="menu-link">
                            <div data-i18n="Requested">Requested</div>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="menu-item  <?= $page == "report" ? "active" : "" ?>">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon bx bx-credit-card"></i>
                    <div data-i18n="Rent Reports">Rent Reports</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="rent_reports" class="menu-link ">
                            <div data-i18n="By Property">By Property</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="payment_reports" class="menu-link">
                            <div data-i18n="Payment Chart">Payment Chart</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <div data-i18n="Defaulted">Defaulted</div>
                        </a>
                    </li>
                </ul>
            </li>

        <?php
        }
        ?>

        <!-- Forms & Tables -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Account Info</span></li>
        <!-- Forms -->
        <li class="menu-item <?= $page == "profile" ? "active" : "" ?>">
            <a href="edit_landlord" class="menu-link ">
                <i class="menu-icon bx bxs-user-account"></i>
                <div data-i18n="Your Profile">Your Profile</div>
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
                <i class="menu-icon bx bx-lock-open-alt"></i>
                <div data-i18n="Logout">Logout</div>
            </a>
        </li>

    </ul>
</aside>