<?php
if(isset($_GET['updategraph']) && ($_GET['updategraph'] == '1')) {
		
	$valid_update_query = mysqli_fetch_array(mysqli_query($conn, "SELECT `users` FROM `percentage_graph_data` WHERE `percentage` = '101'"));
	$update_diff = time('now')-$valid_update_query['users'];
				
	if($update_diff >= '3600') {
			
		// KILL OLD GRAPH TABLE
		$kill_old_graph_table = mysqli_query($conn, "TRUNCATE TABLE `percentage_graph_data`");
		
		// SELECT HIGHEST PERCENTAGE AND ROUND UP TO NEXT QUARTER PERCENT AS CAP FOR CURRENT GRAPH
		$select_highest_percentage = mysqli_fetch_array(mysqli_query($conn, "SELECT `percent` FROM `data1` ORDER BY `percent` DESC LIMIT 1"));
		$highest_percentage = $select_highest_percentage['percent'];
		$highest_percentage = $highest_percentage*4;
		$highest_percentage = ceil($highest_percentage);
		$highest_percentage = $highest_percentage/4;		
		
		// BUILD NEW TABLE CONTENT
		$percentagearray = array('101', '0.25', '0.5', '0.75', '1', '1.25', '1.5', '1.75', '2', '2.25', '2.5', '2.75', '3', '3.25', '3.5', '3.75', '4', '4.25', '4.5', '4.75', '5', '5.25', '5.5', '5.75', '6', '6.25', '6.5', '6.75', '7', '7.25', '7.5', '7.75', '8', '8.25', '8.5', '8.75', '9', '9.25', '9.5', '9.75', '10', '10.25', '10.5', '10.75', '11', '11.25', '11.5', '11.75', '12', '12.25', '12.5', '12.75', '13', '13.25', '13.5', '13.75', '14', '14.25', '14.5', '14.75', '15', '15.25', '15.5', '15.75', '16', '16.25', '16.5', '16.75', '17', '17.25', '17.5', '17.75', '18', '18.25', '18.5', '18.75', '19', '19.25', '19.5', '19.75', '20', '20.25', '20.5', '20.75', '21', '21.25', '21.5', '21.75', '22', '22.25', '22.5', '22.75', '23', '23.25', '23.5', '23.75', '24', '24.25', '24.5', '24.75', '25', '25.25', '25.5', '25.75', '26', '26.25', '26.5', '26.75', '27', '27.25', '27.5', '27.75', '28', '28.25', '28.5', '28.75', '29', '29.25', '29.5', '29.75', '30', '30.25', '30.5', '30.75', '31', '31.25', '31.5', '31.75', '32', '32.25', '32.5', '32.75', '33', '33.25', '33.5', '33.75', '34', '34.25', '34.5', '34.75', '35', '35.25', '35.5', '35.75', '36', '36.25', '36.5', '36.75', '37', '37.25', '37.5', '37.75', '38', '38.25', '38.5', '38.75', '39', '39.25', '39.5', '39.75', '40', '40.25', '40.5', '40.75', '41', '41.25', '41.5', '41.75', '42', '42.25', '42.5', '42.75', '43', '43.25', '43.5', '43.75', '44', '44.25', '44.5', '44.75', '45', '45.25', '45.5', '45.75', '46', '46.25', '46.5', '46.75', '47', '47.25', '47.5', '47.75', '48', '48.25', '48.5', '48.75', '49', '49.25', '49.5', '49.75', '50', '50.25', '50.5', '50.75', '51', '51.25', '51.5', '51.75', '52', '52.25', '52.5', '52.75', '53', '53.25', '53.5', '53.75', '54', '54.25', '54.5', '54.75', '55', '55.25', '55.5', '55.75', '56', '56.25', '56.5', '56.75', '57', '57.25', '57.5', '57.75', '58', '58.25', '58.5', '58.75', '59', '59.25', '59.5', '59.75', '60', '60.25', '60.5', '60.75', '61', '61.25', '61.5', '61.75', '62', '62.25', '62.5', '62.75', '63', '63.25', '63.5', '63.75', '64', '64.25', '64.5', '64.75', '65', '65.25', '65.5', '65.75', '66', '66.25', '66.5', '66.75', '67', '67.25', '67.5', '67.75', '68', '68.25', '68.5', '68.75', '69', '69.25', '69.5', '69.75', '70', '70.25', '70.5', '70.75', '71', '71.25', '71.5', '71.75', '72', '72.25', '72.5', '72.75', '73', '73.25', '73.5', '73.75', '74', '74.25', '74.5', '74.75', '75', '75.25', '75.5', '75.75', '76', '76.25', '76.5', '76.75', '77', '77.25', '77.5', '77.75', '78', '78.25', '78.5', '78.75', '79', '79.25', '79.5', '79.75', '80', '80.25', '80.5', '80.75', '81', '81.25', '81.5', '81.75', '82', '82.25', '82.5', '82.75', '83', '83.25', '83.5', '83.75', '84', '84.25', '84.5', '84.75', '85', '85.25', '85.5', '85.75', '86', '86.25', '86.5', '86.75', '87', '87.25', '87.5', '87.75', '88', '88.25', '88.5', '88.75', '89', '89.25', '89.5', '89.75', '90', '90.25', '90.5', '90.75', '91', '91.25', '91.5', '91.75', '92', '92.25', '92.5', '92.75', '93', '93.25', '93.5', '93.75', '94', '94.25', '94.5', '94.75', '95', '95.25', '95.5', '95.75', '96', '96.25', '96.5', '96.75', '97', '97.25', '97.5', '97.75', '98', '98.25', '98.5', '98.75', '99', '99.25', '99.5', '99.75', '100');
		
		foreach($percentagearray as $percentage) {
			if($percentage == '101') {
					$spam_prevention = mysqli_query($conn, "INSERT INTO `percentage_graph_data` (`percentage`, `users`) VALUES ('" .$percentage. "', '" .time('now'). "')");
			}
			if($percentage <= $highest_percentage) {
				if($percentage != '101') {
									
					$fetch_amount_of_users_sql = "SELECT *, COUNT(`id`) AS `sum_users` FROM `data1` WHERE `percent` < '" .$percentage. "' AND `percent` >= '" .($percentage-0.25). "'";
					$fetch_amount_of_users = mysqli_fetch_array(mysqli_query($conn, $fetch_amount_of_users_sql));
					
					$insert_into_graph_table_sql = "INSERT INTO `percentage_graph_data` (`percentage`, `users`) VALUES ('" .$percentage. "', '" .$fetch_amount_of_users['sum_users']. "')";
					$insert_into_graph_table = mysqli_query($conn, $insert_into_graph_table_sql);
				}
			}
		}
		echo '<p style="color: green;">Thanks for updating!</p>';
	}
	elseif($update_diff < '3600') {
		echo '<p id="error">Sorry, updating the graph is allowed only once every one hour. Next update possible in: ' .(3600-$update_diff). ' seconds.</p>';
	}
}
			
echo '<div id="graph_users" style="width: 75%; height: 500px"></div>';

$last_update = mysqli_fetch_array(mysqli_query($conn, "SELECT `users` FROM `percentage_graph_data` WHERE `percentage` = '101'"));
$last_update = time('now')-$last_update['users'];

if($last_update >= '3600') {
	echo '<p id="cent"><span style="background-color: green;"><a href="?updategraph=1" style="text-decoration: none;">Update graph</a></span></p>';
}

$remaining_time = 3600-$last_update;

if($remaining_time >= '0') {
	$remaining_time_text = 'next update available in ' .$remaining_time. ' seconds';
}
elseif($remaining_time < '0') {
	$remaining_time_text = 'update available! see button below';
}

?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
	google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(drawChart);

	function drawChart() {
		var data = google.visualization.arrayToDataTable([
		['Percentage', 'Users'],
		  
		<?php
		$fetch_table_rows = mysqli_query($conn, "SELECT * FROM `percentage_graph_data` WHERE `percentage` != '101'");
		while($rows = mysqli_fetch_array($fetch_table_rows)) {
			// outputs json format for javascript: ['0.5%', number],
			echo "['" .($rows['percentage']-0.25). "-" .$rows['percentage']. "%', " .$rows['users']. "],";
		}		  
		?>
          
		]);

		var options = {
			title: 'Distribution of completed % (<?php echo $remaining_time_text; ?>)',
			curveType: 'function',
			backgroundColor: '#D6CDAE',
			legend: { position: 'none' },
			vAxis: {
				viewWindow: {
					min: 0 },
				gridlines: { 
					color: 'grey' },
			}
		};

		var chart = new google.visualization.LineChart(document.getElementById('graph_users'));

		chart.draw(data, options);
	}
</script>
