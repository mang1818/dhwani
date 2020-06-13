<?php

use yii\helpers\Html;
use app\modules\api\models\District;


/* @var $this yii\web\View */
/* @var $model app\modules\api\models\Child */

$this->title = 'Add Child';
?>
<style>
.wrap{
    background-color : #F8F8F8 !important;
}
.child-details{
    background-color : #FFFFFF;
}
.detail-box{
    margin  : 4% 0% 4% 4%;
}
.detail-box .row{
    margin-bottom : 4%;
}
label{
    font : 16px Arial, sans-serif;
    color : #000000;
}
.details{
    font : 16px Arial, sans-serif;
    color : #333333;
}
</style>
<div class="container child-details">
    <div class="col-md-12 detail-box">
        <div class="row">

        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="name">Name: </label>
                <span class="details"><?= ucwords($childDetails['name']);?></span>
            </div>
            <div class="col-md-4">
                <label for="sex">Sex: </label>
                <span class="details"><?php 
                    $gender = ['Male','Female'];
                    echo $gender[$childDetails['sex']]??'NA';
                ?></span>
            </div>
            <div class="col-md-4">
                <label for="dob">Date Of Birth: </label>
                <span class="details"><?= $childDetails['dob']?></span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="fname">Father's Name: </label>
                <span class="details"><?= ucwords($childDetails['father_name'])??'NA';?></span>
            </div>
            <div class="col-md-4">
                <label for="mname">Mother's Name: </label>
                <span class="details"><?= ucwords($childDetails['mother_name'])??'NA';?></span>
            </div>
            <div class="col-md-4">
                <label for="district">District: </label>
                <span class="details"><?= ucwords($childDetails['district'])??'NA';?></span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="state">State: </label>
                <span class="details"><?= ucwords($childDetails['state'])??'NA';?></span>
            </div>
        </div>
    </div>
</div>