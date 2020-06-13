<?php

/* @var $this yii\web\View */

$this->title = 'Dhwani app';
?>

<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-md-4"><b>Name : </b><?php echo $userData['name'];?></div>
                <div class="col-md-4"><b>Organization : </b><?php echo $userData['designation'];?></div>
                <div class="col-md-4"><b>Designation : </b><?php echo $userData['organization'];?></div>
            </div>
        </div>
    </div>
</div>