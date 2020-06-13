<?php

/* @var $this yii\web\View */

$this->title = 'Dhwani app';
?>
<style>
    table.child_list{
        box-shadow : 0 0px 3px rgba(0, 0, 0, 0.25), 0 5px 30px rgba(0, 0, 0, 0.22);
        margin-top : 3%;
        border-radius : 10px;
        font : 14px Arial, sans-serif;
    }
    th{
        color : #989898;
    }
    .float-right{
        float : right;
    }
    .modal-dialog-full-width {
        width: 100% !important;
        height: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        max-width:none !important;

    }

    .modal-content-full-width  {
        height: auto !important;
        min-height: 100% !important;
        border-radius: 0 !important;
        background-color: #ececec !important 
    }

    .modal-header-full-width  {
        border-bottom: 1px solid #9ea2a2 !important;
    }

    .modal-footer-full-width  {
        border-top: 1px solid #9ea2a2 !important;
    }
    button.close{
        float : left;
    }
</style>
<div class="container" style="margin-top:5%;">
    <div class="row">
        <div class="float-right">
        <a href="add-child" class="btn btn-success float-right">Add Child</a>
        </div>
    </div>
    <div class="row">
        <table class="table table-striped table-responsive child_list">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Sex</th>
                    <th>Date Of Birth</th>
                    <th>Father's Name</th>
                    <th>Mother's Name</th>
                    <th>State</th>
                    <th>district</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($child as $key => $value){?>
                <tr>
                    <td><?= $value['name']?></td>
                    <td><?= $value['sex']?></td>
                    <td><?= $value['dob']?></td>
                    <td><?= $value['father_name']??'NA'?></td>
                    <td><?= $value['mother_name']??'NA'?></td>
                    <td><?= $value['state_name']?></td>
                    <td><?= $value['district_name']?></td>
                    <td><a class="btn btn-success" href="child-view?id=<?= $value['id'];?>">View</button></td>

                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</div>