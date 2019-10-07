<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\HousingEstate */

$this->title = 'Crear Housing Estate';
$this->params['breadcrumbs'][] = ['label' => 'Housing Estates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="housing-estate-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
