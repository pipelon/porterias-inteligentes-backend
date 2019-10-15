<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Apartments */

$this->title = 'Crear apartamento';
$this->params['breadcrumbs'][] = ['label' => 'Apartamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apartments-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
