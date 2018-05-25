<?php 
$sidebarMenus = common\models\UserRules::getAccessibleMenuByRole(Yii::$app->user->identity->user_role_id);
?>
<nav class="pcoded-navbar">
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">
        <div class="">
            <div class="main-menu-header">
                <!-- <img class="img-80 img-radius" src="#" alt="User-Profile-Image"> -->
                <div class="user-details">
                    <span id="more-details"><?= common\components\Common::getLoginName(); ?><i class="fa fa-caret-down"></i></span>
                </div>
            </div>

            <div class="main-menu-content">
                <ul>
                    <li class="more-details">
                        <a href="<?= Yii::$app->urlManager->createUrl(['users/update', 'id'=> Yii::$app->user->identity->id]); ?>"><i class="ti-user"></i>Profile</a>
                        <a href="<?= Yii::$app->urlManager->createUrl('site/logout'); ?>"><i class="ti-layout-sidebar-left"></i>Logout</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="pcoded-navigation-label">Navigation</div>
        <ul class="pcoded-item pcoded-left-item">
        <?php foreach ($sidebarMenus as $key => $value) {
            //IF NOT SUB MENUS
            if(!isset($value['subMenus'])) {
            ?>
            <li class="">
                <a href="<?= Yii::$app->urlManager->createUrl($value['url'])?>" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="<?= $value['class_icon'] ?>"></i></span>
                    <span class="pcoded-mtext"><?= $value['title']; ?></span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <?php } else if(isset($value['subMenus'])) { ?>
                <li class="pcoded-hasmenu pcoded-trigger" dropdown-icon="style3" subitem-icon="style7">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="<?= $value['class_icon'] ?>"></i><b>B</b></span>
                        <span class="pcoded-mtext"><?= $value['title']; ?></span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                    <ul class="pcoded-submenu" style="display: block;">
                        <?php foreach ($value['subMenus'] as $k => $val) { ?>
                            <li class="">
                                <a href="<?= Yii::$app->urlManager->createUrl($val['url'])?>" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext"><?= $val['title']; ?></span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>                            
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
        <?php } ?>
        
        </ul>
    </div>
</nav>