<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Gates */

$this->title = 'Crear puerta';
$this->params['breadcrumbs'][] = ['label' => 'Puertas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gates-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
