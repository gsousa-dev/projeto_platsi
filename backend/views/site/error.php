<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="breadcrumbs">
    <ol class="breadcrumb">
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="#">Pages</a>
        </li>
        <li class="active">System</li>
    </ol>
</div>
<div class="row">
    <div class="col-md-12 page-404">
        <div class="number font-green"> 404 </div>
        <div class="details">
            <h3>Oops! You're lost.</h3>
            <p> We can not find the page you're looking for.<br/>
                <a href="index.html"> Return home </a> or try the search bar below.
            </p>
            <form action="#">
                <div class="input-group input-medium">
                    <input type="text" class="form-control" placeholder="keyword...">
                    <span class="input-group-btn">
                        <button type="submit" class="btn green">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>