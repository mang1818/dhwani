<?php

/* @var $this yii\web\View */

$this->title = 'Dhwani app';
?>
<style>
    .box{
        border : 1px solid green;
        padding : 50px 25px 80px 25px;
        box-shadow : 0 0px 0px rgba(0, 0, 0, 0.25), 0 5px 5px rgba(0, 0, 0, 0.22);
    }
    span.seq{
        border : 1px solid #4FAE65;
        border-radius : 50%;
        padding : 30px;
        font: 16px Arial, sans-serif;
        color : #397E39;
        margin-right : 15%;
    }
    .state_name, .district_name{
        color : #397E39;
        font : 16px Arial, sans-serif;
        font-weight : bold;
        margin-bottom : 5%;
    }
    span.new-seq{
        border : 1px dotted #4FAE65;
    }
    .first-box{
        background-color : #F8F8F8;
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
    .district-btn{
        color : #fff;
        background : #397E39;
        margin-top : 5%;
    }
    .seq-block{
        display:inline-block;
        margin-left : 1%;
    }
    .detail-block{
        float: right;
        margin-right: 15%;
        margin-top: -5%;
    }
</style>
<div class="container" style="margin-top:5%;">
    <div class="row">
    <div class="col-md-4">
        <div class="panel box first-box">
        <div class="row seq-block">
        <span class="seq new-seq">+</span>
        </div>
            <div class="row detail-block">
            <form id="create_district" action="/site/district" method="post">
            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken; ?>">
            <div class="row state_list">
                <select name="District[state_id]" id="state_list" class="form-control">
                    <option value="">Select State</option>
                    <?php foreach($states as $key  => $val){?>
                        <option value="<?= $val->id ?>"><?= $val->name ?></option>
                    <?php }?>
                </select>
            </div>
                <div class="row">
                <input type="text" id="district-name" class="form-control" name="District[name]" placeholder="Enter District Name">
                </div>
            <div class="row save-state">
                <span><button type="submit" class="btn btn-small district-btn">Save</button></span>
            </div>
        </form>
        </div>
        </div>
    </div>

        <?php foreach($district as $key => $value){?>
                <div class="col-md-4">
                    <div class="panel box">
                        <div class="row seq-block">
                            <span class="seq">
                                <?php echo $key+1;?>
                            </span>
                        </div>

                        <div class="row detail-block" style="margin-right:32%">
                        <div class="row state_name">
                            <?php echo $value['state_name'];?>
                        </div>
                        <div class="row district_name">
                        <?php echo $value['name'];?>
                        </div>
                        </div>
                    </div>
                </div>
        <?php }?>
    </div>
</div>