<?php
/* @var $this PropdetailController */
/* @var $model Propdetail */

$this->breadcrumbs=array(
	'Property'=>array('index'),
	'Search',
);

$this->menu=array(
	array('label'=>'List Property', 'url'=>array('index'), 'visible'=>Yii::app()->user->checkAccess('ListProperty')),
	array('label'=>'Post Property', 'url'=>array('create'), 'visible'=>Yii::app()->user->checkAccess('CreateProperty')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#propdetail-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Search Property</h1>

<p>
Click on <?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?> for more search options.
</p>

<div class="search-form" style="display:none">
<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'propdetail-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'category',
		//'fk_proptype',
		'name',
		'location',
		'description',		
		//'fk_owner',
		'value',
		//'dateposted',
		'status',
		//'photos',		
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
