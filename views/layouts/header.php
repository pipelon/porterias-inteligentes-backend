<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?=
    Html::a('<span class="logo-mini">TC</span><span class="logo-lg">TeCuido</span>', Yii::$app->homeUrl, ['class' => 'logo'])
    ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <!-- Messages: style can be found in dropdown.less-->                
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="flaticon-alert-2"></i>
                        <span class="label label-danger">10</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 10 notifications</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-warning text-yellow"></i> Very long description here that may
                                        not fit into the page and may cause design problems
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-red"></i> 5 new members joined
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-user text-red"></i> You changed your username
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li>
                <!-- Tasks: style can be found in dropdown.less -->                
                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?=
                        Html::img('@web/images/default-user.png',
                                [
                                    'alt' => 'User Image',
                                    'class' => 'user-image'
                        ])
                        ?>                        
                        <span class="hidden-xs"><?= Yii::$app->user->identity->fullName; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <?=
                            Html::img('@web/images/default-user.png',
                                    [
                                        'alt' => 'User Image',
                                        'class' => 'img-circle'
                            ])
                            ?>
                            <p>
                                <?php
                                $date = new DateTime(Yii::$app->user->identity->created);
                                ?>
                                <small>
                                    Rol: 
                                    <b>
                                        <?php
                                        $roles = implode(", ", array_keys(Yii::$app->user->identity->getRoles()));
                                        echo trim(strtolower(preg_replace("/[A-Z]/", ' $0', $roles)));
                                        ?>
                                    </b>
                                </small>
                                <small>Creado el <?= $date->format('d \d\e\l m \d\e Y'); ?></small>
                            </p>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <?=
                                Html::a(
                                        '<i class="flaticon-users"></i> Perfil',
                                        ['/users/view', 'id' => Yii::$app->user->identity->id],
                                        ['class' => 'btn btn-default']
                                )
                                ?>
                            </div>
                            <div class="pull-right">
                                <?=
                                Html::a(
                                        '<i class="flaticon-logout"></i> Salir',
                                        ['/site/logout'],
                                        ['data-method' => 'post', 'class' => 'btn btn-default']
                                )
                                ?>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>