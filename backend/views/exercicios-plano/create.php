<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
//-
use common\models\TipoExercicio;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\filters\ExercicioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Selecione os exercícios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exercicio-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>Selecione os exercícios que pretende adicionar ao plano de treino. Atenção, que só pode selecionar entre 8 e 12 exercícios</p>

    <?= GridView::widget([
        'id' => 'grid',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'yii\grid\CheckboxColumn',
                'header' => false,
                'name' => 'keys',
                'multiple' => true,
                'checkboxOptions' => function ($model, $key, $index, $column) {
                    return ['value' => $key];
                },
            ],
            'descricao',
            [
                'attribute' => 'tipo_exercicio',
                'value' => 'tipoExercicio.tipo',
                'filter' => Html::activeDropDownList($searchModel, 'tipo_exercicio',
                    ArrayHelper::map(TipoExercicio::find()->asArray()->all(), 'id', 'tipo'), ['class' => 'form-control', 'prompt' => 'Selecione o tipo de exercício']),
            ],
            //['class' => 'yii\grid\ActionColumn', 'template'=>'{update} {delete}'],
        ],
    ]); ?>

    <?= Html::button('Submeter', ['class' => 'btn btn green', 'onclick' => 'submit()']) ?>

</div>
<script>
    window.onload = function() {
        if(localStorage.getItem("keys") !== null) {
            var storedKeys = getKeys();

            storedKeys.forEach(function(element) {
                $("input[type=checkbox][value=" + element + "]")
                    .change(function () {
                        var isChecked = $(this).is(":checked");
                        if (!isChecked) {
                            var index = storedKeys.indexOf(element);
                            if (index > -1) {
                                storedKeys.splice(index, 1);
                                if(storedKeys.length > 0) {
                                    localStorage.setItem("keys", JSON.stringify(storedKeys));
                                } else {
                                    localStorage.removeItem("keys");
                                }
                            }
                        }
                    })
                    .prop("checked", true)
                    .parent('span').addClass("checked");
            });
        }
    };

    function getKeys() {
        var selectedKeys = $('#grid').yiiGridView('getSelectedRows'); //catches the keys of the selected rows
        var storedKeys = JSON.parse(localStorage.getItem("keys")); //retrieves stored keys as a JSON object

        if (!storedKeys) {
            //there are no stored keys
            if (selectedKeys.length > 0) {
                return selectedKeys
            }
        } else {
            //stored keys exist

            //firstly storedKeys is concatenated with selectedKeys
            //then is is filtered so it doesn't have duplicated keys
            return (storedKeys.concat(selectedKeys)).filter(getUniqueKeys);
        }
    }

    window.onbeforeunload = function () {
        var keys = getKeys();

        if (keys) {
            //keys are stringified and then stored locally within the user's browser
            localStorage.setItem("keys", JSON.stringify(keys));
        }
    };

    function getUniqueKeys(value, index, self) {
        return self.indexOf(value) === index;
    }

    function post(keys) {
        $.ajax({
            type: "POST",
            data: {keylist: keys},
            dataType: "json",
            success: localStorage.removeItem("keys") //clears localStorage
        });
    }

    function submit() {
        var keys = getKeys();

        if (!keys) {
            alert('Ainda não selecionou nenhum exercício.');
        } else {
            if(keys.length < 8 || keys.length > 12) {
                //error
                alert('Número de exercícios obrigatório: entre 8 e 12.\n' + 'Selecionou ' + keys.length + ' exercício(s).');
            } else {
                //success
                post(keys);
            }
        }
    }
</script>