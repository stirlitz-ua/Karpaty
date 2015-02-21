<link rel="stylesheet" href="../css/style.css">
<style>
select,option {width:30%;padding:2px;}
</style>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script>
		jQuery(function($){
			$("#year").change(function(){ 
				var url = $(this).val();
				$.ajax({
				  url: url,
				  type: "GET",
				  dataType: "html",
				  cache: true,
				  beforeSend: function(){ console.log('get Models');  $("#loadingBar").show(); },
				  complete: function(){  $("#loadingBar").hide(); },
				  success: function(html){
					 $("#models").html(html);
					 $("#models").removeAttr('disabled');
					 $("#model").show();
					 
					 $("#marka").attr('disabled', 'disabled');
					 $("#cat").attr('disabled', 'disabled');
					 $("#categ").attr('disabled', 'disabled');
					 $("#type").attr('disabled', 'disabled');
					 $("#typee").attr('disabled', 'disabled');
					 $("#IDhere").hide();
				  },
				  error: function(html){
					 alert('error');
				  }
			   });
			});
			
			$("#models").change(function(){
				var url = $(this).val();
				$.ajax({
				  url: url,
				  type: "GET",
				  dataType: "html",
				  cache: true,
				  beforeSend: function(){ console.log('get Marka'); $("#loadingBar").show(); },
				  complete: function(){  $("#loadingBar").hide(); },
				  success: function(html){
					 $("#marka").html(html);
					 $("#marka").removeAttr('disabled');
					 $("#comp").show();
				  
					$("#cat").attr('disabled', 'disabled');
					$("#type").attr('disabled', 'disabled');
					$("#IDhere").hide();
				},
				  error: function(html){
					 alert('error');
				  }
			   });
			});
			
			$("#marka").change(function(){
				var url = $(this).val();
				$.ajax({
				  url: url,
				  type: "GET",
				  dataType: "html",
				  cache: true,
				  beforeSend: function(){ console.log('get Cats'); $("#loadingBar").show(); },
				  complete: function(){  $("#loadingBar").hide(); },
				  success: function(html){
					 $("#cat").html(html);
					 $("#cat").removeAttr('disabled');
					 $("#categ").show();
					 
					$("#type").attr('disabled', 'disabled');
					$("#IDhere").hide();					 

				  },
				  error: function(html){
					 alert('error');
				  }
			   });
			});
			
			$("#cat").change(function(){
				var url = $(this).val();
				$.ajax({
				  url: url,
				  type: "GET",
				  dataType: "html",
				  cache: true,
				  beforeSend: function(){ console.log('get Cats'); $("#loadingBar").show(); },
				  complete: function(){  $("#loadingBar").hide(); },
				  success: function(html){
					 $("#type").html(html);
					 $("#type").removeAttr('disabled');
					 $("#typee").show();
					 
					$("#IDhere").hide();

				  },
				  error: function(html){
					 alert('error');
				  }
			   });
			});
			
			$("#type").change(function(){
				var url = $(this).val();
				$.ajax({
				  url: url,
				  type: "GET",
				  dataType: "html",
				  cache: true,
				  beforeSend: function(){ console.log('get ID'); $("#loadingBar").show(); },
				  complete: function(){  $("#loadingBar").hide(); },
				  success: function(html){
					 $("#IDhere").html(html);
					 $("#IDhere").show();
				  },
				  error: function(html){
					 alert('error');
				  }
			   });
			});
		});
	</script>


	<h1>Выберите год:</h1>
	<select id="year">
		<option value="/accessories/select.php?year=2014">Выберите год</option>
		<option value="/accessories/select.php?year=2014">2014</option>
		<option value="/accessories/select.php?year=2013">2013</option>
		<option value="/accessories/select.php?year=2012">2012</option>
		<option value="/accessories/select.php?year=2011">2011</option>
		<option value="/accessories/select.php?year=2010">2010</option>
		<option value="/accessories/select.php?year=2009">2009</option>
		<option value="/accessories/select.php?year=2008">2008</option>
		<option value="/accessories/select.php?year=2007">2007</option>
		<option value="/accessories/select.php?year=2006">2006</option>
		<option value="/accessories/select.php?year=2005">2005</option>
		<option value="/accessories/select.php?year=2004">2004</option>
		<option value="/accessories/select.php?year=2003">2003</option>
		<option value="/accessories/select.php?year=2002">2002</option>
		<option value="/accessories/select.php?year=2001">2001</option>
		<option value="/accessories/select.php?year=2000">2000</option>
	</select>
	
	
	<div id="ajaxHere">
		<div>
			<div id="model" disabled="disabled">
				<h1>Выберите модель:</h1>
			</div>
			<select id="models" disabled="disabled"> <option>Выберите модель:</option></select>
		</div>
		<div>
			<div id="comp" disabled="disabled">
				<h1>Выберите комплектацию:</h1>
			</div>
			<select id="marka" disabled="disabled"> <option>Выберите комплектацию:</option></select>
		</div>
		<div>
			<div id="categ" disabled="disabled">
				<h1>Выберите категорию:</h1>
			</div>
			<select id="cat" disabled="disabled"><option>Выберите категорию:</option></select>
		</div>
		<div>
			<div id="typee" disabled="disabled">
				<h1>Выберите тип запчасти:</h1>
			</div>
			<select id="type" disabled="disabled"><option>Выберите тип запчасти:</option></select>
		</div>
		<div>
			<div id="IDhere" style="display:none;"></div>
		</div>
		<img src="images/loading.gif" width="107" height="auto" style="display:none" id="loadingBar" />
		
	</div>
<p align="left"><button type="submit" class="btn btn-default" onclick="$('#mySelect option:selected').removeAttr('selected'); $('#marka option:selected').removeAttr('selected'); $('#models option:selected').removeAttr('selected'); $('#cat option:selected').removeAttr('selected');
$('#type option:selected').removeAttr('selected'); $('#IDhere').empty();
">Новый поиск</button></p>
	