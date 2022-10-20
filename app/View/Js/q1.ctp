<div class="alert  ">
<button class="close" data-dismiss="alert"></button>
My Answer</div>

<!-- <p>
1. Make the Description, Quantity, Unit price field as text at first. When user clicks the text, it changes to input field for use to edit. Refer to the following video.

</p>


<p>
2. When user clicks the add button at left top of table, it wil auto insert a new row into the table with empty value. Pay attention to the input field name. For example the quantity field

<?php //echo htmlentities('<input name="data[1][quantity]" class="">')?> ,  you have to change the data[1][quantity] to other name such as data[2][quantity] or data["any other not used number"][quantity]

</p>



<div class="alert alert-success">
	<button class="close" data-dismiss="alert"></button>
	The table you start with
</div> -->

<table class="table table-striped table-bordered table-hover">
	<thead>
		<th>
			<span id="add_item_button" class="btn mini green addbutton" onclick="addToObj=false">
				<i class="icon-plus"></i>
			</span>
		</th>
		<th>Description</th>
		<th>Quantity</th>
		<th>Unit Price</th>
	</thead>

	<tbody id="table_body"></tbody>
</table>


<!-- <p></p>
<div class="alert alert-info ">
<button class="close" data-dismiss="alert"></button>
Video Instruction</div> -->

<!-- <p style="text-align:left;">
<video width="78%"   controls>
  <source src="<?php //echo Router::url("/video/q3_2.mov") ?>">
Your browser does not support the video tag.
</video>
</p> -->





<?php $this->start('script_own');?>
<script>
$(document).ready(function(){

	var counter = 0;

	function renderRow(idNo) {
		return  `
		<tr>
			<td></td>
			<td>
				<textarea name="data[${idNo}][description]" class="m-wrap input description required" rows="2" ></textarea>
				<span class="input_text"></span>
			</td>
			<td>
				<input name="data[${idNo}][quantity]" class="input" />
				<span class="input_text"></span>
			</td>
			<td>
				<input name="data[${idNo}][unit_price]" class="input" />
				<span class="input_text"></span>
			</td>
		</tr>
		`;
	}

	$("#table_body").append(renderRow(counter));

	$("#add_item_button").click(function() {

		counter += 1;
		
		$("#table_body").prepend(renderRow(counter));

	});

	$("#table_body").on('blur', '.input', function() {
		//alert($(this).val())

		var input = $(this);
		var text = input.siblings();

		if(input.val() !== '') {
			$(this).hide();
			text.html(input.val());
			text.show();
		}

		return;
	});

	$("#table_body").on('click', '.input_text', function() {
		var inputSibling = $(this).siblings();
		$(this).hide();
		inputSibling.show();
	});

	
});
</script>
<?php $this->end();?>

