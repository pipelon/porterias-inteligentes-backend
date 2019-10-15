<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Residents */

$this->title = 'Crear residentes';
$this->params['breadcrumbs'][] = ['label' => 'Residentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="residents-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
