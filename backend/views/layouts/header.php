<nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">
                    <div class="navbar-logo">
                        <a class="mobile-menu waves-effect waves-light" id="mobile-collapse" href="#!">
                            <i class="ti-menu"></i>
                        </a>
                    <div class="mobile-search waves-effect waves-light">
                        <div class="header-search">
                            <div class="main-search morphsearch-search">
                                <div class="input-group">
                                    <span class="input-group-prepend search-close"><i class="ti-close input-group-text"></i></span>
                                    <input type="text" class="form-control" placeholder="Enter Keyword">
                                    <span class="input-group-append search-btn"><i class="ti-search input-group-text"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                        <a href="<?= Yii::$app->homeUrl ?>">
                            <img class="img-fluid back-end-site-logo" src="<?= $headerLogo ?>" alt="Theme-Logo" />
                        </a>
                        <a class="mobile-options waves-effect waves-light">
                            <i class="ti-more"></i>
                            </a>
                    </div>
                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li>
                                <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                            </li>
                            <li class="header-search">
                                <div class="main-search morphsearch-search">
                                    <div class="input-group">
                                        <span class="input-group-prepend search-close"><i class="ti-close input-group-text"></i></span>
                                        <input type="text" class="form-control" placeholder="Enter Keyword">
                                        <span class="input-group-append search-btn"><i class="ti-search input-group-text"></i></span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
                      <i class="ti-fullscreen"></i>
                    </a>
                            </li>
                        </ul>
                        <ul class="nav-right">
                            <li class="user-profile header-notification">
                                <a href="#!" class="waves-effect waves-light">
                      <!-- <img src="#" class="img-radius" alt="User-'Profi'le-Image"> -->
                    <span>
                        <?= common\components\Common::getLoginName(); ?>
                    </span>
                      <i class="ti-angle-down"></i>
                    </a>
                                <ul class="show-notification profile-notification">
                                    <li class="waves-effect waves-light">
                                        <a href="<?= Yii::$app->urlManager->createUrl(['users/update', 'id'=> Yii::$app->user->identity->id]); ?>">
                                            <i class="ti-user"></i><?= Yii::t('app', 'My Profile') ?>
                                        </a>
                                    </li>
                                    <li class="waves-effect waves-light">
                                        <a href="<?= Yii::$app->urlManager->createUrl(['users/change-password']); ?>">
                          <i class="ti-key"></i><?= Yii::t('app', 'Change Password') ?>
                                        </a>
                                    </li>
                                    <!-- <li class="waves-effect waves-light">
                                        <a href="email-inbox.html">
                          <i class="ti-email"></i> My Messages
                        </a>
                                    </li> -->
                                    <!-- <li class="waves-effect waves-light">
                                        <a href="auth-lock-screen.html">
                          <i class="ti-lock"></i> Lock Screen
                        </a>
                                    </li> -->
                                    <li class="waves-effect waves-light">
                                        <a href="<?= Yii::$app->urlManager->createUrl('site/logout'); ?>">
                          <i class="ti-layout-sidebar-left"></i> Logout
                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>