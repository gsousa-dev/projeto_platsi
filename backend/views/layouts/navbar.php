<?php
use yii\widgets\Menu;

echo Menu::widget([
        'options' => ['class' => 'nav navbar-nav'],
        'encodeLabels' => false,
        'activeCssClass' => 'dropdown dropdown-fw dropdown-fw-disabled  active open selected',
        'submenuTemplate' => '<ul class="dropdown-menu dropdown-menu-fw">{items}</ul>',
        'itemOptions' => ['class' => 'dropdown dropdown-fw'],
        'items' => [
            [
                'label' => '<i class="fa fa-database" aria-hidden="true"></i>RBAC',
                'url' => 'javascript:;',
                'visible' => Yii::$app->user->can('admin'),
                'items' => [
                    ['label' => '<i class="fa fa-address-card"></i> Assignments', 'url' => ['/admin/assignment']],
                    ['label' => '<i class="fa fa-user"></i> Roles', 'url' => ['/admin/role']],
                    ['label' => '<i class="fa fa-key"></i> Permissions', 'url' => ['/admin/permission']],
                    ['label' => '<i class="fa fa-wrench"></i> Rules', 'url' => ['/admin/rule']],
                ],
                'active' => Yii::$app->controller->module->id == 'admin',
            ],
            [
                'label' => '<i class="fa fa-users"></i>UTILIZADORES',
                'url' => 'javascript:;',
                'visible' => Yii::$app->user->can('gerir_utilizadores'),
                'items' => [
                    ['label' => '<i class="fa fa-server"></i> Ver Utilizadores', 'url' => ['/user']],
                    ['label' => '<i class="fa fa-user-plus"></i> Criar Utilizador', 'url' => ['/user/create']],
                ],
                'active' => Yii::$app->controller->id == 'user',
            ],
            [
                'label' => '<i class="fa fa-users"></i> CLIENTES',
                'url' => 'javascript:;',
                'visible' => Yii::$app->user->can('personal_trainer'),
                'items' => [
                    ['label' => 'Os Meus Clientes', 'url' => ['/cliente']],
                ],
                'active' => Yii::$app->controller->id == 'cliente',
            ],
            [
                'label' => '<i class="fa fa-list-alt"></i>EXERCÍCIOS',
                'url' => 'javascript:;',
                'visible' => Yii::$app->user->can('personal_trainer'),
                'items' => [
                    ['label' => 'Lista de Exercícios', 'url' => ['/exercicio']],
                    ['label' => 'Criar Exercício', 'url' => ['/exercicio/create']],
                ],
                'active' => Yii::$app->controller->id == 'exercicio',
            ],
        ],
]);