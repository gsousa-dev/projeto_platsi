<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $model backend\models\forms\UpdateUserForm */

?>
<div class="page-content-col">
    <!-- BEGIN PAGE BASE CONTENT -->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PROFILE SIDEBAR -->
            <div class="profile-sidebar">
                <!-- PORTLET MAIN -->
                <div class="portlet light profile-sidebar-portlet bordered">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic">
                        <img src="/<?= $user->profile_picture ?>" class="img-responsive" alt=""></div>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name"> <?= $user->name ?> </div>
                        <div class="profile-usertitle-job"> <?= $user->UserType() ?> </div>
                    </div>
                    <!-- END SIDEBAR USER TITLE -->
                    <!-- SIDEBAR MENU -->
                    <div class="profile-usermenu">
                        <ul class="nav">
                            <li>
                                <a href="<?= '/user/profile?id=' . Yii::$app->user->identity->getId() ?>"><i class="icon-home"></i> Overview </a>
                            </li>
                            <li class="active">
                                <a href="#"><i class="icon-settings"></i> Account Settings </a>
                            </li>
                        </ul>
                    </div>
                    <!-- END MENU -->
                </div>
            </div>
            <!-- END BEGIN PROFILE SIDEBAR -->
            <!-- BEGIN PROFILE CONTENT -->
            <div class="profile-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light bordered">
                            <?php
                            if ($model->scenario == 'update-personal-info') {
                                echo $this->render('account-settings/update-personal-info', ['model' => $model]);
                            } elseif ($model->scenario == 'change-avatar') {
                                echo $this->render('account-settings/change-avatar', ['model' => $model]);
                            } elseif ($model->scenario == 'change-password') {
                                echo $this->render('account-settings/change-password', ['model' => $model]);
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
