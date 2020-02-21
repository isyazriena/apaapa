<!DOCTYPE html>
<html lang="en">
<head>
	<title>Table V04</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="csstable/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="csstable/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="csstable/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="csstable/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="csstable/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="csstable/vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="csstable/css/util.css">
	<link rel="stylesheet" type="text/css" href="csstable/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-table100">
			<div class="wrap-table100">

				<div class="table100 ver3 m-b-110">
					<div class="table100-head">
						<table>
							<thead>
								<tr class="row100 head">
									<th class="cell100 column1">No</th>
									<th class="cell100 column2">Project Name</th>
									<th class="cell100 column3">Person In Charge</th>
									<th class="cell100 column4">Status</th>
									<th class="cell100 column5">Estimated Date End</th>
									<th class="cell100 column6">(i)</th>
									<th class="cell100 column7">Delete</th>
								</tr>
							</thead>
						</table>
					</div>

					<div class="table100-body js-pscroll">
						<table>
							<tbody>
								<tr class="row100 body">
									<td class="cell100 column1">Like a butterfly</td>
									<td class="cell100 column2">Boxing</td>
									<td class="cell100 column3">9:00 AM - 11:00 AM</td>
									<td class="cell100 column4">Aaron Chapman</td>
									<td class="cell100 column5">10</td>
									<td class="cell100 column6">10</td>
									<td class="cell100 column7">10</td>
								</tr>

								<tr class="row100 body">
									<td class="cell100 column1">Mind & Body</td>
									<td class="cell100 column2">Yoga</td>
									<td class="cell100 column3">8:00 AM - 9:00 AM</td>
									<td class="cell100 column4">Adam Stewart</td>
									<td class="cell100 column5">15</td>
									<td class="cell100 column6">10</td>
									<td class="cell100 column7">10</td>
								</tr>

								<tr class="row100 body">
									<td class="cell100 column1">Crit Cardio</td>
									<td class="cell100 column2">Gym</td>
									<td class="cell100 column3">9:00 AM - 10:00 AM</td>
									<td class="cell100 column4">Aaron Chapman</td>
									<td class="cell100 column5">10</td>
									<td class="cell100 column6">10</td>
									<td class="cell100 column7">10</td>
								</tr>

								<tr class="row100 body">
									<td class="cell100 column1">Wheel Pose Full Posture</td>
									<td class="cell100 column2">Yoga</td>
									<td class="cell100 column3">7:00 AM - 8:30 AM</td>
									<td class="cell100 column4">Donna Wilson</td>
									<td class="cell100 column5">15</td>
									<td class="cell100 column6">10</td>
									<td class="cell100 column7">10</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>


<!--===============================================================================================-->	
	<script src="csstable/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="csstable/vendor/bootstrap/js/popper.js"></script>
	<script src="csstable/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="csstable/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="csstable/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function(){
			var ps = new PerfectScrollbar(this);

			$(window).on('resize', function(){
				ps.update();
			})
		});
			
		
	</script>
<!--===============================================================================================-->
	<script src="csstable/js/main.js"></script>

</body>
</html>