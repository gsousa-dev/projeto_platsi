<?php
use yii\widgets\Menu;

echo Menu::widget([
        'options' => ['class' => 'nav navbar-nav'],
        'encodeLabels' => false,
        'items' => [
                [
                    'options' => ['class' => 'dropdown dropdown-fw dropdown-fw-disabled  active open selected'],
                    'label' => '<i class="fa fa-database" aria-hidden="true"></i>RBAC',
                    'url' => 'javascript:;',
                    'items' => [
                        ['label' => '<i class="fa fa-address-card"></i> Assignments', 'url' => ['/admin/assignment']],
                        ['label' => '<i class="fa fa-user"></i> Roles', 'url' => ['/admin/role']],
                        ['label' => '<i class="fa fa-key"></i> Permissions', 'url' => ['/admin/permission']],
                        ['label' => '<i class="fa fa-wrench"></i> Rules', 'url' => ['/admin/rule']],
                    ],
                    'visible' => Yii::$app->user->can('admin')
                ],
                [
                    'options' => ['class' => 'dropdown dropdown-fw'],
                    'label' => '<i class="fa fa-users"></i>UTILIZADORES',
                    'url' => 'javascript:;',
                    'items' => [
                        ['label' => '<i class="fa fa-server"></i> Ver Utilizadores', 'url' => ['/user']],
                        ['label' => '<i class="fa fa-user-plus"></i> Criar Utilizador', 'url' => ['/user/create']],
                    ],
                    'visible' => Yii::$app->user->can('admin')
                ],
                [
                    'options' => ['class' => 'dropdown dropdown-fw dropdown-fw-disabled  active open selected'],
                    'label' => '<i class="fa fa-users"></i>UTILIZADORES',
                    'url' => 'javascript:;',
                    'items' => [
                        ['label' => '<i class="fa fa-server"></i> Ver Utilizadores', 'url' => ['/user']],
                        ['label' => '<i class="fa fa-user-plus"></i> Criar Utilizador', 'url' => ['/user/create']],
                    ],
                    'visible' => Yii::$app->user->can('secretaria')
                ],
                [
                    'options' => ['class' => 'dropdown dropdown-fw dropdown-fw-disabled  active open selected'],
                    'label' => '<i class="fa fa-users"></i> CLIENTES',
                    'url' => 'javascript:;',
                    'items' => [
                        ['label' => 'Os Meus Clientes', 'url' => ['/cliente/meus-clientes']],
                    ],
                    'visible' => Yii::$app->user->can('personal_trainer')
                ],
                [
                    'options' => ['class' => 'dropdown dropdown-fw'],
                    'label' => '<i class="fa fa-list-alt"></i>EXERCÍCIOS',
                    'url' => 'javascript:;',
                    'items' => [
                        ['label' => 'Lista de Exercícios', 'url' => ['/exercicio']],
                        ['label' => 'Criar Exercício', 'url' => ['/exercicio/create']],
                    ],
                    'visible' => Yii::$app->user->can('personal_trainer')
                ],
        ],
        'submenuTemplate' => '<ul class="dropdown-menu dropdown-menu-fw">{items}</ul>'
]);