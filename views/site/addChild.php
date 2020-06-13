<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\api\models\Child */

$this->title = 'Add Child';
?>
<style>
.wrap{
    background-color : #F8F8F8 !important;
}
.child-create{
    background-color : #FFFFFF;
}
input[type="text"],
select.form-control {
  background: transparent;
  border: none;
  border-bottom: 1px solid #585858;
  -webkit-box-shadow: none;
  box-shadow: none;
  border-radius: 0;
}

input[type="text"]:focus,
select.form-control:focus {
  -webkit-box-shadow: none !important;
  box-shadow: none !important;
}
h3{
    text-align : center;
    color : #397F3A;
}
.control-label{
    font-weight : normal;
}
</style>
<div class="child-create col-md-4 col-md-offset-4">

    <h3>Add Child</h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>