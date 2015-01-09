<?php
use bioengine\backend\assets\AppAsset;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
$pageTitle = $this->title ? $this->title : \Yii::$app->name;
?>

<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <?php $this->head() ?>
    </head>
    <body class="skin-blue">
    <?php $this->beginBody() ?>
    <!-- header logo: style can be found in header.less -->
    <header class="header">
        <a href="/" class="logo">
            <!-- Add the class icon to your logo image or logo icon to add the margining -->
            BioEngine
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-right">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="glyphicon glyphicon-user"></i>
                            <span>Sonic <i class="caret"></i></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header bg-light-blue">
                                <img src="http://uploads.bioware.ru/profile/photo-thumb-1.png?_r=1420268727"
                                     class="img-circle" alt="User Image"/>

                                <p>
                                    Sonic
                                    <small>www.BioWare.ru</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="#" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="left-side sidebar-offcanvas">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="http://uploads.bioware.ru/profile/photo-thumb-1.png?_r=1420268727" class="img-circle"
                             alt="User Image"/>
                    </div>
                    <div class="pull-left info">
                        <p>Hello, Sonic</p>
                    </div>
                </div>
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu">
                    <?php
                    $menu = \bioengine\common\components\MenuBuilder::getMenu();
                    foreach ($menu as $menuItem) {
                        ?>
                        <li class="<?= count(
                            $menuItem['items']
                        ) > 0 ? 'treeview' : '' ?> <?= $menuItem['active'] ? 'active' : '' ?>">
                            <a href="#">
                                <i class="fa <?= $menuItem['icon'] ?>"></i> <span><?= $menuItem['title'] ?></span>
                                <?php
                                if (count($menuItem['items']) > 0) {
                                    ?>
                                    <i class="fa fa-angle-left pull-right"></i>
                                <?php
                                }
                                ?>
                            </a>
                            <?php
                            if (count($menuItem['items']) > 0) {
                                ?>
                                <ul class="treeview-menu">
                                    <?php
                                    foreach ($menuItem['items'] as $subItem) {
                                        ?>
                                        <li class="<?= $subItem['active'] ? 'active' : '' ?>"><a
                                                href="<?= $subItem['url'] ?>"><i class="fa fa-angle-double-right"></i>
                                                <?= $subItem['title'] ?></a>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            <?php
                            }
                            ?>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Right side column. Contains the navbar and content of the page -->
        <aside class="right-side">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <?= $pageTitle ?>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Админка</a></li>
                    <li class="active"><?= $pageTitle ?></li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <?= $content ?>

            </section>
            <!-- /.content -->
        </aside>
        <!-- /.right-side -->
    </div>
    <!-- ./wrapper -->

    <!-- add new calendar event modal -->
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>