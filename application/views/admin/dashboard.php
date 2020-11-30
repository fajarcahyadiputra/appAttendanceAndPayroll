<?php 
if (!$this->session->userdata('username')) {

  redirect('auth');
} else {
  if ($this->session->userdata("role") === "karyawan") {
    redirect("karyawan/homeKaryawan");
  } 
  ?>
  <!-- Container Fluid-->
  <div class="container-fluid" id="container-wrapper">

    <div class="card">
      <div class="card-header" style="background-color: mintcream">
        <h3 class="text-dark">DASHBOARD</h3>
      </div>
      <div class="card-body">
        
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
            <div class="panel-group">
              <div class="panel panel-default">
                <div class="panel-heading">Grafik Barang Masuk </div>
                <canvas id="myChart" width="50" height="20"></canvas>
              </div>

            </div>
          </div>
        </div>
        <hr>
        <hr>	
        <hr>		
        <div class="row">	
          <div class="col-sm-12">
            <div class="panel-group">
              <div class="panel panel-default">
                <div class="panel-heading">Grafik Barang Keluar</div>
                <canvas id="mychart2" width="50" height="20"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

</div>
<!---Container Fluid-->
</div>


<script>
//   let labelMasuk = [
// 	<?php 
// 	foreach($chartMasuk as $labelMasuk =>  $cm){
// 		echo "'$labelMasuk',";
// 	}
//  ?>
//   ]

//   let dataMasuk = [
// 	<?php 
// 	foreach($chartMasuk as $labelMasuk =>  $cm){
// 		echo "'$cm',";
// 	}
//  ?>
//   ]

//  let warnaMasuk = [
// 	<?php 
// 	for($i = 0; $i < count($chartMasuk); $i++){
// 		$index1 = rand(rand($i,100), 300);
// 		$index2 = rand(rand($i,100), 200);
// 		$index3 = rand(rand($i, 100), 100);
// 		echo "'rgba({$index1},{$index2},{$index3}, 0.2)',";
// 	}
//  ?>
//  ]

//   var ctx = document.getElementById('myChart').getContext('2d');
//   var myChart = new Chart(ctx, {
// 			type: 'bar',
// 			data: {
// 				labels: labelMasuk,
// 				datasets: [{
// 					label: '#Grafik Barang Masuk',
// 					data: dataMasuk,
// 					backgroundColor: warnaMasuk,
// 					borderWidth: 1
// 				}]
// 			},
// 			options: {
// 				scales: {
// 					yAxes: [{
// 						ticks: {
// 							beginAtZero: true
// 						}
// 					}]
// 				}
// 			}
// 		});
// 	</script>

// 	<script>

// 		let labelKeluar = [
// 			<?php 
// 			foreach($chartKeluar as $labelKeluar =>  $ck){
// 				echo "'$labelKeluar',";
// 			}
// 		?>
// 		]

// 		let dataKeluar = [
// 			<?php 
// 			foreach($chartKeluar as $labelKeluar =>  $ck){
// 				echo "'$ck',";
// 			}
// 		?>
// 		]

// 		let warnaKeluar = [
// 			<?php 
// 			for($i = 0; $i < count($chartKeluar); $i++){
// 				$index1 = rand(rand($i,100), 300);
// 				$index2 = rand(rand($i,100), 200);
// 				$index3 = rand(rand($i, 100), 100);
// 				echo "'rgba({$index1},{$index2},{$index3}, 0.2)',";
// 			}
// 		?>
// 		]

// 		var ctx = document.getElementById('mychart2').getContext('2d');
// 		var myChart = new Chart(ctx, {
// 			type: 'bar',
// 			data: {
// 				labels: labelKeluar,
// 				datasets: [{
// 					label: '# Grafik Barang Masuk',
// 					data: dataKeluar,
// 					backgroundColor: warnaKeluar,
// 					borderWidth: 1
// 				}]
// 			},
// 			options: {
// 				scales: {
// 					yAxes: [{
// 						ticks: {
// 							beginAtZero: true
// 						}
// 					}]
// 				}
// 			}
// 		});
</script>

<?php } ?>