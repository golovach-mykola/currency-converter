function isInt(value) {
  return !isNaN(value) && 
         parseInt(Number(value)) == value && 
         !isNaN(parseInt(value, 10));
}
function currencyConverter(){
	$('#btn-calculate').attr("disabled","disabled").html('Loading <i class="fa fa-refresh fa-spin"></i>');
	let startCurr = $('#startCurr').val();
	let finishCurr = $('#finishCurr .dd-selected-text').text();
	let amount = $('#amount').val();
	if(isInt(amount)){
		if(amount==0){
			$('#cost').val(0);
			$('#btn-calculate').removeAttr("disabled").html('Calculate <i class="fa fa-chevron-right"></i>');
		}else{
			amount = parseInt(amount);
			if(startCurr==finishCurr){
				$('#cost').val(amount);
				$('#btn-calculate').removeAttr("disabled").html('Calculate <i class="fa fa-chevron-right"></i>');
			}else{
				$.ajax({
					type: "POST",
					url: "process.php",
					data: {
						'start_curr': startCurr,
						'finish_curr': finishCurr,
						'amount': amount
					},
					cache: false,
					dataType: 'json',
					success: function(result){
						if(result.success){
							$('#cost').val(result.data);
							$('#btn-calculate').removeAttr("disabled").html('Calculate <i class="fa fa-chevron-right"></i>');
						}else{
							alert(result.message);
							$('#btn-calculate').removeAttr("disabled").html('Calculate <i class="fa fa-chevron-right"></i>');
						}			
					}
				});				
			}
		}
	}else{
		alert('Please input an integer value!');
		$('#btn-calculate').removeAttr("disabled").html('Calculate <i class="fa fa-chevron-right"></i>');
	}
}
$(document).ready(function() {
	let checked = false;
	$('#btn-calculate').click(function(){
		currencyConverter();
	});
	$('#finishCurr').ddslick({
		height : 300,
		onSelected: function(selectedData){
			if(checked){
				currencyConverter();
			}
		}
	});
	checked = true;
	$('#btn-calculate').trigger('click');
});