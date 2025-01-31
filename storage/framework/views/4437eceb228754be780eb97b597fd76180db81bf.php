<!DOCTYPE html>

<html
    lang="en"
    class="light-style layout-navbar-fixed layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="/assets/"
    data-template="vertical-menu-template"
>
<head>
    <meta charset="utf-8"/>
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Admin panel</title>

    <meta name="description" content=""/>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/img/favicon/favicon.ico"/>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet"
    />

    <!-- Icons -->
    <link rel="stylesheet" href="/assets/vendor/fonts/boxicons.css"/>
    <link rel="stylesheet" href="/assets/vendor/fonts/fontawesome.css"/>
    <link rel="stylesheet" href="/assets/vendor/fonts/flag-icons.css"/>

    <!-- Core CSS -->
    <link rel="stylesheet" href="/assets/vendor/css/rtl/core.css" class="template-customizer-core-css"/>
    <link rel="stylesheet" href="/assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css"/>
    <link rel="stylesheet" href="/assets/css/demo.css"/>

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css"/>
    <link rel="stylesheet" href="/assets/vendor/libs/typeahead-js/typeahead.css"/>
    <link rel="stylesheet" href="/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css"/>
    <link rel="stylesheet" href="/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css"/>
    <link rel="stylesheet" href="/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css?v=1"/>
    <link rel="stylesheet" href="/assets/vendor/libs/select2/select2.css"/>
    <link rel="stylesheet" href="/assets/vendor/libs/formvalidation/dist/css/formValidation.min.css"/>

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="/assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="/assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="/assets/js/config.js?v=1"></script>

    <!-- Core JS -->
    <script src="/assets/vendor/js/core.js"></script>

    <!-- Vendors JS -->
    <script src="/assets/vendor/libs/moment/moment.js"></script>
    <script src="/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="/assets/vendor/libs/select2/select2.js"></script>
    <script src="/assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js"></script>
    <script src="/assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js"></script>
    <script src="/assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js"></script>
    <script src="/assets/vendor/libs/cleavejs/cleave.js"></script>
    <script src="/assets/vendor/libs/cleavejs/cleave-phone.js"></script>
</head>

<body>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
                <a href="<?php echo e(route('index')); ?>" class="app-brand-link">
              <span class="app-brand-logo demo">
                <svg
                    width="25"
                    viewBox="0 0 25 42"
                    version="1.1"
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                >
                  <defs>
                    <path
                        d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z"
                        id="path-1"
                    ></path>
                    <path
                        d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z"
                        id="path-3"
                    ></path>
                    <path
                        d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z"
                        id="path-4"
                    ></path>
                    <path
                        d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z"
                        id="path-5"
                    ></path>
                  </defs>
                  <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                      <g id="Icon" transform="translate(27.000000, 15.000000)">
                        <g id="Mask" transform="translate(0.000000, 8.000000)">
                          <mask id="mask-2" fill="white">
                            <use xlink:href="#path-1"></use>
                          </mask>
                          <use fill="#696cff" xlink:href="#path-1"></use>
                          <g id="Path-3" mask="url(#mask-2)">
                            <use fill="#696cff" xlink:href="#path-3"></use>
                            <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                          </g>
                          <g id="Path-4" mask="url(#mask-2)">
                            <use fill="#696cff" xlink:href="#path-4"></use>
                            <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                          </g>
                        </g>
                        <g
                            id="Triangle"
                            transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) "
                        >
                          <use fill="#696cff" xlink:href="#path-5"></use>
                          <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                        </g>
                      </g>
                    </g>
                  </g>
                </svg>
              </span>
                    <span class="app-brand-text demo menu-text fw-bolder ms-2">Panel</span>
                </a>

                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                    <i class="bx bx-chevron-left bx-sm align-middle"></i>
                </a>
            </div>

            <div class="menu-inner-shadow"></div>

            <ul class="menu-inner py-1">
                <li class="menu-item <?php if(array_search(Route::currentRouteName(), ['index', 'index.active', 'index.online', 'index.offline', 'index.archives'], true) !== false): ?> active <?php endif; ?>">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-home-circle"></i>
                        <div>Bots</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item <?php if(Route::currentRouteName() === 'index'): ?> active <?php endif; ?>">
                            <a href="<?php echo e(route('index')); ?>" class="menu-link">
                                <div>List</div>
                            </a>
                        </li>
                        <li class="menu-item <?php if(Route::currentRouteName() === 'index.active'): ?> active <?php endif; ?>">
                            <a href="<?php echo e(route('index.active')); ?>" class="menu-link">
                                <div>Active List</div>
                            </a>
                        </li>
                        <li class="menu-item <?php if(Route::currentRouteName() === 'index.online'): ?> active <?php endif; ?>">
                            <a href="<?php echo e(route('index.online')); ?>" class="menu-link">
                                <div>Online List</div>
                            </a>
                        </li>
                        <li class="menu-item <?php if(Route::currentRouteName() === 'index.offline'): ?> active <?php endif; ?>">
                            <a href="<?php echo e(route('index.offline')); ?>" class="menu-link">
                                <div>Offline List</div>
                            </a>
                        </li>
                        <li class="menu-item <?php if(Route::currentRouteName() === 'index.archives'): ?> active <?php endif; ?>">
                            <a href="<?php echo e(route('index.archives')); ?>" class="menu-link">
                                <div>Archive List</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-item <?php if(array_search(Route::currentRouteName(), ['grabber', 'extensions'], true) !== false): ?> active <?php endif; ?>">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-grid"></i>
                        <div>Info</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item <?php if(Route::currentRouteName() === 'grabber'): ?> active <?php endif; ?>">
                            <a href="<?php echo e(route('grabber')); ?>" class="menu-link">
                                <div>Grabber List</div>
                            </a>
                        </li>
                        <li class="menu-item <?php if(Route::currentRouteName() === 'extensions'): ?> active <?php endif; ?>">
                            <a href="<?php echo e(route('extensions')); ?>" class="menu-link">
                                <div>Extensions List</div>
                            </a>
                        </li>
                        <li class="menu-item <?php if(Route::currentRouteName() === 'counter_urls'): ?> active <?php endif; ?>">
                            <a href="<?php echo e(route('counter_urls')); ?>" class="menu-link">
                                <div>Counter Url List</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <?php if(auth()->user()->role->slug === 'admin'): ?>
                    <li class="menu-item <?php if(array_search(Route::currentRouteName(), ['injects'], true) !== false): ?> active <?php endif; ?>">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-injection"></i>
                            <div>Injects</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item <?php if(Route::currentRouteName() === 'injects'): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('injects')); ?>" class="menu-link">
                                    <div>List</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if(auth()->user()->role->slug === 'admin'): ?>
                    <li class="menu-item <?php if(array_search(Route::currentRouteName(), ['clipper'], true) !== false): ?> active <?php endif; ?>">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-copy"></i>
                            <div>Clipper</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item <?php if(Route::currentRouteName() === 'clipper'): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('clipper')); ?>" class="menu-link">
                                    <div>List</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                <li class="menu-item <?php if(array_search(Route::currentRouteName(), ['accounts', 'addresses'], true) !== false): ?> active <?php endif; ?>">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-bitcoin"></i>
                        <div>Crypto</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item <?php if(Route::currentRouteName() === 'accounts'): ?> active <?php endif; ?>">
                            <a href="<?php echo e(route('accounts')); ?>" class="menu-link">
                                <div>Accounts List</div>
                            </a>
                        </li>
                        <?php if(auth()->user()->role->slug === 'admin'): ?>
                            <li class="menu-item <?php if(Route::currentRouteName() === 'addresses'): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('addresses')); ?>" class="menu-link">
                                    <div>Addresses List</div>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>

                <li class="menu-item <?php if(array_search(Route::currentRouteName(), ['commands'], true) !== false): ?> active <?php endif; ?>">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-command"></i>
                        <div>Commands</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item <?php if(Route::currentRouteName() === 'commands'): ?> active <?php endif; ?>">
                            <a href="<?php echo e(route('commands')); ?>" class="menu-link">
                                <div>Send</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-item <?php if(array_search(Route::currentRouteName(), ['settings'], true) !== false): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('settings')); ?>" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-cog"></i>
                        <div>Settings</div>
                    </a>
                </li>
            </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->

            <nav
                class="layout-navbar container-fluid navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                id="layout-navbar"
            >
                <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                        <i class="bx bx-menu bx-sm"></i>
                    </a>
                </div>

                <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                    <ul class="navbar-nav flex-row align-items-center ms-auto">
                        <!-- Style Switcher -->
                        <li class="nav-item me-2 me-xl-0">
                            <a class="nav-link style-switcher-toggle hide-arrow" href="javascript:void(0);">
                                <i class="bx bx-sm"></i>
                            </a>
                        </li>
                        <!--/ Style Switcher -->

                        <!-- User -->
                        <li class="nav-item navbar-dropdown dropdown-user dropdown">
                            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                               data-bs-toggle="dropdown">
                                <div class="avatar avatar-online">
                                    <img src="/assets/img/avatars/default.png" alt
                                         class="w-px-40 h-auto rounded-circle"/>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="<?php echo e(route('profile.settings')); ?>">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar avatar-online">
                                                    <img src="/assets/img/avatars/default.png" alt
                                                         class="w-px-40 h-auto rounded-circle"/>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <span
                                                    class="fw-semibold d-block"><?php echo e(\Illuminate\Support\Facades\Auth::user()->name); ?></span>
                                                <small
                                                    class="text-muted"><?php echo e(\Illuminate\Support\Facades\Auth::user()->role->name); ?></small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="<?php echo e(route('profile.settings')); ?>">
                                        <i class="bx bx-cog me-2"></i>
                                        <span class="align-middle">Settings</span>
                                    </a>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="<?php echo e(route('logout')); ?>">
                                        <i class="bx bx-power-off me-2"></i>
                                        <span class="align-middle">Log Out</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!--/ User -->
                    </ul>
                </div>

                <!-- Search Small Screens -->
                <div class="navbar-search-wrapper search-input-wrapper d-none">
                    <input
                        type="text"
                        class="form-control search-input container-xxl border-0"
                        placeholder="Search..."
                        aria-label="Search..."
                    />
                    <i class="bx bx-x bx-sm search-toggler cursor-pointer"></i>
                </div>
            </nav>

            <!-- / Navbar -->

            <!-- Content wrapper -->
            <?php echo $__env->yieldContent('content'); ?>
            <!-- / Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>

    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>
</div>
<!-- / Layout wrapper -->

<script src="/assets/js/main.js"></script>

</body>
</html>
<?php /**PATH C:\OSPanel\domains\friezer-backend\resources\views/pages/layout.blade.php ENDPATH**/ ?>