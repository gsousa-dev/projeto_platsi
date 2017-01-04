<?php
use yii\widgets\Menu;
use yii\helpers\Url;

echo Menu::widget([
        'options' => ['class' => 'nav navbar-nav'],
        'encodeLabels' => false,
        'items' => [
                [
                    'options' => ['class' => 'dropdown dropdown-fw dropdown-fw-disabled  active open selected'],
                    'label' => '<i class="fa fa-database" aria-hidden="true"></i>RBAC',
                    'url' => Url::to('javascript:;'),
                    'items' => [
                        ['label' => '<i class="fa fa-address-card"></i> Assignments', 'url' => ['admin/assignment']],
                        ['label' => '<i class="fa fa-user"></i> Roles', 'url' => ['admin/role']],
                        ['label' => '<i class="fa fa-key"></i> Permissions', 'url' => ['admin/permission']],
                        ['label' => '<i class="fa fa-wrench"></i> Rules', 'url' => ['admin/rule']],
                    ],
                    'visible' => Yii::$app->user->can('admin')
                ],
                [
                    'options' => ['class' => 'dropdown dropdown-fw'],
                    'label' => '<i class="fa fa-users"></i>UTILIZADORES',
                    'url' => Url::to('javascript:;'),
                    'items' => [],
                    'visible' => Yii::$app->user->can('admin')
                ],
                [
                    'options' => ['class' => 'dropdown dropdown-fw dropdown-fw-disabled  active open selected'],
                    'label' => '<i class="fa fa-users"></i>UTILIZADORES',
                    'url' => Url::to('javascript:;'),
                    'items' => [],
                    'visible' => Yii::$app->user->can('secretaria')
                ],
                [
                    'options' => ['class' => 'dropdown dropdown-fw dropdown-fw-disabled  active open selected'],
                    'label' => '<i class="fa fa-users"></i>OS MEUS CLIENTES',
                    'url' => Url::to('javascript:;'),
                    'items' => [],
                    'visible' => Yii::$app->user->can('personal_trainer')
                ],
                [
                    'options' => ['class' => 'dropdown dropdown-fw'],
                    'label' => '<i class="fa fa-list-alt"></i>EXERCÍCIOS',
                    'url' => Url::to('javascript:;'),
                    'items' => [],
                    'visible' => Yii::$app->user->can('personal_trainer')
                ],
        ],
        'submenuTemplate' => '<ul class="dropdown-menu dropdown-menu-fw">{items}</ul>'
]);