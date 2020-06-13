<?php

/* @var $this yii\web\View */

$this->title = 'Dhwani app';
?>
<style>
    .box{
        border : 1px solid green;
        padding : 50px 25px 50px 25px;
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
    span.state_name{
        color : #397E39;
        font : 16px Arial, sans-serif;
        font-weight : bold;
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
    .save-state{
        margin-top : 5%;
    }
    .state-btn{
        color : #fff;
        background : #397E39;
    }
    span.new-seq{
        border : 1px dotted #4FAE65;
    }
    .first-box{
        background-color : #F8F8F8;
    }
</style>
<div class="container" style="margin-top:5%;">
    <div class="row">
    <div class="col-md-4">
        <div class="panel box first-box">
        <div class="row" style="display:inline-block">
        <span class="seq new-seq">+</span>
        </div>
            <div class="row" style="float: right;margin-right: 15%;margin-top: -5%;">
            <form id="create_state" action="/site/states" method="post">
            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken; ?>">
                <div class="row">
                    <input type="text" id="state-name" name="State[name]" placeholder="Enter State Name">
                </div>
            <div class="row save-state">
                <span><button type="submit" class="btn btn-small state-btn">Save</button></span>
            </div>
        </form>
        </div>
        </div>
    </div>
        <?php foreach($states as $key => $value){?>
                <div class="col-md-4">
                    <div class="panel box">
                        <span class="seq"><?php echo $key+1;?></span><span class="state_name"><?php echo $value->name;?></span>
                    </div>
                </div>
        <?php }?>
    </div>
</div>