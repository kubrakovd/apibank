<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use kartik\widgets\Typeahead;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use kartik\widgets\DatePicker;
use yii\data\Pagination;
use yii\filters\VerbFilter;

// echo "<pre>";
// print_r($_GET);
// print_r($pag_query);
// echo "</pre>";
?>

<h1 class="text-center"><?=Yii::t('app', 'Search transaction by parameters') ?></h1>

<div class="panel search">
    <div class="panel-body">
    	<?php
    	$form = ActiveForm::begin([
    		'method' => 'GET',
    		]);
    		?>
    		<div class="row">
    			<div class="col-sm-4">
    				<?= $form->field($model, 'amount')->textInput(['placeholder'=>'Please write the amount of Transaction', 'class'=>'form-control', 'value'=>isset($_GET['Transaction']['amount']) && $_GET['Transaction']['amount']?$_GET['Transaction']['amount']:''])->label(Yii::t('app','Amount of transaction'));?>
    			</div>
    			<!-- /.col-sm-4 -->
    			<div class="col-sm-4">
    				<?= $form->field($model, 'customerId')->textInput(['placeholder'=>'Please write the customer Id', 'class'=>'form-control', 'value'=>isset($_GET['Transaction']['customerId']) && $_GET['Transaction']['customerId']?$_GET['Transaction']['customerId']:''])->label(Yii::t('app','Customer Id'));?>
    			</div>
    				<!-- /.col-sm-4 -->
    			<div class="col-sm-4">
    			<?php
                    echo 'Date of Transaction';
                    echo DatePicker::widget([
                            'model' => $model,
                            'attribute' => 'date',
                            'type' => DatePicker::TYPE_INPUT,
                             'pluginOptions' => [
                                'autoclose'=>true,
                                'format' => 'dd-M-yyyy'
                        ],
                    ]);
                  ?>
    			</div>
    		</div>
    		<!-- /.row -->
              <div class="row">
                <div class="col-sm-2">
                        <label for="per_page">Items per page</label>
                       <select class="form-control"  id="per_page" name="per_page">
                          <option <?= isset($_REQUEST['per_page']) && $_REQUEST['per_page']==5?'selected':'' ?> value="5">5</option>
                          <option <?= isset($_REQUEST['per_page']) && $_REQUEST['per_page']==10?'selected':'' ?> value="10">10</option>
                          <option <?= isset($_REQUEST['per_page']) && $_REQUEST['per_page']==50?'selected':'' ?> value="50">50</option>
                      </select>
                </div>
                <!-- /.col-sm-2 -->
          </div>
          <!-- /.row -->

				<div class="row text-center">
			<div class="col-sm-6">
				<?= Html::submitButton(Yii::t('app','Search Transaction!'),['class'=>'btn btn-success btn-lg']);?>
			</div>
			<div class="col-sm-6">
				<?=Html::a(Yii::t('app','Refresh!'),['transaction/search/'], ['class'=>'btn btn-danger btn-lg'])?>
			</div>
		</div>
		<!-- /.row -->
		<?php
            ActiveForm::end();
        ?>
    </div>
    <?php
    	if (isset($_GET['Transaction'])) {
    	if ($totalItems>0 ){
    	echo '<div class="row">';
        ?>
        <div class="col-sm-offset-1 col-sm-1">
				<div class="panel panel-primary">
	        		<div class="panel-heading text-center">№</div>
	        	</div>
            </div>
            <!-- /.col-sm-3 -->

	        <div class="col-sm-2">
	        	<div class="panel panel-primary">
	        		<div class="panel-heading text-center">Сustomer ID</div>
	        	</div>
	        </div>
            <!-- /.col-sm-3 -->
            <div class="col-sm-3">
				<div class="panel panel-primary">
	        		<div class="panel-heading text-center">Date of Transaction</div>
	        	</div>
            </div>
            <!-- /.col-sm-3 -->
             <div class="col-sm-4">
				<div class="panel panel-primary">
	        		<div class="panel-heading text-center">Amount of transaction</div>
	        	</div>
            </div>
            <!-- /.col-sm-3 -->

        <?php
            $i=1;
            foreach ($pag_query as $item) {
        ?>
         <div class="col-sm-offset-1 col-sm-1">
				<div class="panel panel-success">
	        		<div class="panel-heading text-center">
	        			<?= $i?>
	        		</div>
	        	</div>
            </div>
            <!-- /.col-sm-2-->

	        <div class="col-sm-2">
	        	<div class="panel panel-default">
	        		<div class="panel-heading text-center">
	        			<?= $item['customerId'] ?>
	        		</div>
	        	</div>
	        </div>
            <!-- /.col-sm-2-->
            <div class="col-sm-3">
				<div class="panel panel-default">
	        		<div class="panel-heading text-center">
	        			<?= date('d-m-Y H:i:s', $item['date']) ?>
	        		</div>
	        	</div>
            </div>
            <!-- /.col-sm-3 -->
             <div class="col-sm-4">
				<div class="panel panel-default">
	        		<div class="panel-heading text-center">
	        			<?= $item['amount'] ." " .'$'?>
	        		</div>
	        	</div>
            </div>
            <!-- /.col-sm-3 -->

            <?php
            $i++;
        }
        echo '</div>';
        // <!-- /.row -->
    	}else{
    	?>
	    	<div class="alert alert-info">
	    		<?=Yii::t('app', 'No transactions related to your search!' )?>
	    	</div>

    <?php
    	}
    	}
     ?>
</div>

<div class="text-center">
	<?php
		if (isset($_GET['Transaction'])){
			echo LinkPager::widget(['pagination'=>$pagination]);
        }

    ?>

</div>


