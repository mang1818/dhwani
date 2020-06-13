<?php

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\api\models\State;
use app\modules\api\models\District;

/* @var $this yii\web\View */
/* @var $model app\modules\api\models\Child */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="child-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sex')->dropDownList([1=>'male',2=>'Female'],['prompt'=>'Select Gender']) ?>

    <?= $form->field($model, 'dob')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Enter birth date'],
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'autoclose'=>true
            ]
        ]);?>

    <?= $form->field($model, 'father_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mother_name')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'state_id')->label('State')->dropDownList( 
        ArrayHelper::map(State::find()->all(), 'id', 'name'),[
            'prompt'=>'Select State',
            'onChange' => '
                $.post("'.Url::toRoute('site/list?id=').'"+$(this).val(), function(data){
                $("select#child-district_id").html(data);
            });'
            ]) ?>

    <?= $form->field($model, 'district_id')->label('District')->dropDownList(['prompt'=>'Select District']) ?>
    <?= $form->field($model, 'image')->fileInput() ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>