<?php
	$currencies = array();
    $currencies = array_map(function ($item){
        return array_combine(['country_code','country_fullname','currency_code','currency_name','country_name'], str_getcsv($item));
    }, file('data.csv'));
	$half = round(sizeof($currencies)/2);
?>		
<html>
	<head>
		<title>Currency Converter</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
		<script src="assets/jquery.ddslick.min.js"></script>
		<script src="assets/script.js"></script>
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css' rel='stylesheet' type='text/css'>
	</head>
	<body>
			<div class="container">
				<div class="row">
					<div class="form-container">					
						<div class="col-md-12"><h2>Currency Converter</h2></div>						
						<div class="col-md-5">
							<div class="row">
                                <div class="col-md-2">
                                    <label>USD</label>
                                </div>
                                <div class="col-md-10">
                                    <div class="row">
                                        <input type="text" class="form-control" value="30" name="amount" id="amount">
                                        <input type="hidden" name="startCurr" id="startCurr" value="USD">
                                    </div>
                                </div>
							</div>
						</div>
						<div class="col-md-2 text-center">
						    <button type="button" class="btn btn-primary" id="btn-calculate">Calculate <i class="fa fa-chevron-right"></i></button>
						</div>
						<div class="col-md-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <input type="text" class="form-control" readonly="readonly" name="cost" id="cost">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <select id="finishCurr" name="finishCurr">
                                        <?php
                                        foreach($currencies as $currency){
                                            ?>
                                            <option <?php if($currency['currency_code']=="UAH"){ echo "selected";} ?> value="<?php echo $currency['currency_code']; ?>" data-description="<?php echo $currency['currency_name']; ?>"><?php echo $currency['currency_code']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
						</div>
					</div>
				</div>
			</div>
	</body>
</html>