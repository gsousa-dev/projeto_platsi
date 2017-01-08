<div class="topbar-actions">
    <div class="btn-group-img btn-group">
        <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
            <span>Bem-vindo, <?= Yii::$app->user->identity->username ?></span>
            <img src="/<?= Yii::$app->user->identity->profile_picture ?>" alt="">
        </button>
        <?php
        use yii\widgets\Menu;

        echo Menu::widget([
                'options' => ['class' => 'dropdown-menu-v2', 'role' => 'menu'],
                'encodeLabels' => false,
                'items' => [
                        [
                            'label' => '<i class="icon-user"></i> Meu Perfil',
                            'url' => ['/user/view?id='.Yii::$app->user->identity->getId()],
                        ],
                        [
                            'label' => '<i class="icon-envelope-open"></i> Caixa de Entrada <span class="badge badge-danger">1</span>',
                            'url' => ['/mensagem/inbox'],
                            'visible' => Yii::$app->user->can('personal_trainer')
                        ],
                        [
                            'label' => '<i class="icon-key"></i> Logout',
                            'url' => ['/site/logout'],
                            'template' => '<a href="{url}" data-method="post">{label}</a>',
                        ],
                ]
        ]);
        ?>
    </div>
</div>