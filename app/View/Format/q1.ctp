<?php
//die(var_dump($orders))

?>


<div id="message1">


<?php echo $this->Form->create('Type',array('id'=>'form_type','type'=>'file','class'=>'','method'=>'POST','autocomplete'=>'off','inputDefaults'=>array(
				
				'label'=>false,'div'=>false,'type'=>'text','required'=>false)))?>
	
<?php echo __("Hi, please choose a type below:")?>
<br><br>

<?php 

$options = array();

foreach($orders as $result) {
	$order = $result['Order'];

	$id = $order['id'];
	$name = $order['name'];

	$url = Router::url('/Format/q1_answer/'.$id);

	$html = "<span class='popup-label' data-id='{$id}' style='color:blue; position: relative'>
				{$name}

				<div id='content-{$id}' class='popup-content'>
	 				<span>{$name}</span>
	 				<a href='{$url}'>Save</a>
 				</div>
			</span>";
	
	$options[$name] = __($html);
}

// $options_new = array(
// 	'Type1' => __("
// 	   "),
//    'Type2' => __('
// 	   <span class="popup-label" data-id="2" style="color:blue; position: relative">
// 	   		Type2
			
// 			<div id="content-2" class="popup-content">
// 			   <button onclick="alert(1)">Save</button>
// 		   </div>
// 	   </span>'),
// 	'Type3' => __('
// 		<span class="popup-label" data-id="3" style="color:blue; position: relative">
// 			Type3
				
// 			<div id="content-3" class="popup-content">
// 				<button onclick="alert(1)">Save</button>
// 			</div>
// 		</span>')
//    );


// $options_new = array(
//  		'Type1' => __('
// 			<span class="showDialog onHover" data-id="dialog_1" style="color:blue">
// 				Type1
// 			</span>
// 			<div id="dialog_1" class=" dialog" title="Type 1">
//  				<span style="display:inline-block">
// 					<ul>
// 						<li>Description .......</li>
//  						<li>Description 2</li>
// 					</ul>
// 				</span>
//  			</div>'),
// 		'Type2' => __('
// 			<span class="showDialog onHover" data-id="dialog_2" style="color:blue">Type2</span>
// 			<div id="dialog_2" class=" dialog" title="Type 2">
//  				<span style="display:inline-block">
// 					<ul>
// 						<li>Desc 1 .....</li>
//  						<li>Desc 2...</li>
// 					</ul>
// 				</span>
//  			</div>')
// 		);
		
?>

<?php echo $this->Form->input(
	'type', 
	array(
		'legend'=>false, 
		'type' => 'radio', 
		'options'=>$options,
		'before'=>'<label class="radio line notcheck">',
		'after'=>'</label>' ,
		'separator'=>'</label><label class="radio line notcheck">'
		)
	);
?>


<?php echo $this->Form->end();?>

</div>

<style>
.showDialog:hover{
	text-decoration: underline;
}

.popup-content {
	display: none;
	width: 200px;
	border: 1px solid gray; 
	position: absolute; 
	top: 50%; 
	left: 100%;
	transform: translateY(-50%);
	margin-left: 15px; 
	padding: 20px;
	background: #fff;
	z-index: 1;
}

.popup-content.active {
	display: block;
}

.popup-content::after {
	content: "";
	box-sizing: border-box;
	position: absolute;
	top: 50%; 
	left: 0;
	width: 18px;
	height: 18px;
	background: #fff;
	transform: rotate(46deg) translateX(-80%);
	border-bottom: 1px solid gray;
	border-left: 1px solid gray;
	z-index: 2;
}

#message1 .radio{
	vertical-align: top;
	font-size: 13px;
	postion: relative;
}

.control-label{
	font-weight: bold;
}

.wrap {
	white-space: pre-wrap;
}

</style>

<?php $this->start('script_own')?>
<script>

$(document).ready(function(){
	// $(".dialog").dialog({
	// 	autoOpen: false,
	// 	width: '500px',
	// 	modal: true,
	// 	dialogClass: 'ui-dialog-blue'
	// });

	
	// $(".showDialog").click(function() { 
	// 	var id = $(this).data('id'); 
	// 	$("#"+id).dialog('open'); 
	// });

	$('.popup-label').hover(function() {
		var id = $(this).data('id')

		$('.popup-content').removeClass('active')

		$('#content-'+id).addClass('active')
	});

})


</script>
<?php $this->end()?>