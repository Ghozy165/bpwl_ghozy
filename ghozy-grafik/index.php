<?php
<h1> Muhammad Fariz Bintang </h1>
<h2> Tambahan Baru </h2>
//koneksi ke database
$conn = new mysqli("localhost", "root", "ghozy123", "ghozy_m5");
if ($conn->connect_errno){
    echo die("Failed to connect to MYSQl\L : " . $con->connect_errno);
}

//table1
$rows1 = array();
$table1 = array();
$table1['cols'] = array(
	array('label' => 'kelas', 'type' => 'string'),
	array('label' => 'jumlah_siswa', 'type' => 'number')
);
 
//melakukan query ke database select
$sql = $conn->query("SELECT * FROM kelas");
while($data = $sql->fetch_assoc()){
	$temp = array();
	$temp[] = array('v' => (string)$data['kelas']);
	$temp[] = array('v' => (int)$data['jumlah_siswa']);
	$rows1[] = array('c' => $temp);
}

$table1['rows'] = $rows1;
$jsonTable1 = json_encode($table1);

//table2
$rows2 = array();
$table2 = array();
$table2['cols'] = array(
	array('label' => 'nama', 'type' => 'string'),
	array('label' => 'nilai', 'type' => 'number')
);
 
//melakukan query ke database select
$sql = $conn->query("SELECT * FROM nilai");
while($data = $sql->fetch_assoc()){
	$temp = array();
	$temp[] = array('v' => (string)$data['nama']);
	$temp[] = array('v' => (int)$data['nilai']);
	$rows2[] = array('c' => $temp);
}
$table2['rows'] = $rows2;
$jsonTable2 = json_encode($table2);


//table3
$rows3 = array();
$table3 = array();
$table3['cols'] = array(
	array('label' => 'ukm', 'type' => 'string'),
	array('label' => 'anggota', 'type' => 'number')
);
 
//melakukan query ke database select
$sql = $conn->query("SELECT * FROM ukm");
while($data = $sql->fetch_assoc()){
	$temp = array();
	$temp[] = array('v' => (string)$data['ukm']);
	$temp[] = array('v' => (int)$data['anggota']);
	$rows3[] = array('c' => $temp);
}
$table3['rows'] = $rows3;
$jsonTable3 = json_encode($table3);
?>

<html>
<head>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
 
	google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(drawChart);

//grafik1
	function drawChart() {
		var data = new google.visualization.DataTable(<?php echo $jsonTable1; ?>);
		var options = {'title':'Data Kelas',
					   'width':300,
					   'height':200};
		var chart = new google.visualization.PieChart(document.getElementById('chart_div1'));
		chart.draw(data, options);
	}

//grafik2
    google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(drawChart1);
    function drawChart1() {
         var data = new google.visualization.DataTable(<?php echo $jsonTable2; ?>);
        var options = {'title':'Nilai Siswa',
                    'width':300,
                    'height':200};
        var chart = new google.visualization.LineChart(document.getElementById('chart_div2'));
        chart.draw(data, options);
    }

//grafik3
    google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(drawChart2);
    function drawChart2() {
         var data = new google.visualization.DataTable(<?php echo $jsonTable3; ?>);
        var options = {'title':'Keanggotaan UKM',
                    'width':300,
                    'height':200};
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div3'));
        chart.draw(data, options);
    }

    </script>
</head>
<body>
    <div id="chart_div1"></div>
    <div id="chart_div2"></div>
	<div id="chart_div3"></div>
</body>
</html>
