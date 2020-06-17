<div class="alert icon-alert with-arrow alert-success form-alter" role="alert">
<i class="fa fa-fw fa-check-circle"></i>
<strong> Success ! </strong> <span class="success-message"> Post Order has been updated successfully </span>
</div>
<div class="alert icon-alert with-arrow alert-danger form-alter" role="alert">
<i class="fa fa-fw fa-times-circle"></i>
<strong> Note !</strong> <span class="warning-message"> Empty list cant be ordered </span>
</div>
<ul class="list-unstyled" id="post_list">
<?php
//get rows query
$query = mysqli_query($con, "SELECT * FROM li_ajax_post_load ORDER BY post_order_no ASC");
//number of rows
$rowCount = mysqli_num_rows($query);
if($rowCount > 0){ 
while($row = mysqli_fetch_assoc($query)){ 
$tutorial_id = 	$row['post_id'];
?>
<li data-post-id="<?php echo $row["post_id"]; ?>">
<div class="li-post-group">
<h5 class="li-post-title"><?php echo $row["post_id"].') '.ucfirst($row["post_title"]); ?></h5>
<p class="li-post-desc"><?php echo ucfirst($row["post_desc"]); ?></p>
</div>
</li>


<?php } 
} ?>
</ul>


<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>


$( "#post_list" ).sortable({
	placeholder : "ui-state-highlight",
	update  : function(event, ui)
	{
		var post_order_ids = new Array();
		$('#post_list li').each(function(){
			post_order_ids.push($(this).data("post-id"));
		});
		$.ajax({
			url:"ajax_upload.php",
			method:"POST",
			data:{post_order_ids:post_order_ids},
			success:function(data)
			{
			 if(data){
			 	$(".alert-danger").hide();
			 	$(".alert-success ").show();
			 }else{
			 	$(".alert-success").hide();
			 	$(".alert-danger").show();
			 }
			}
		});
	}
});