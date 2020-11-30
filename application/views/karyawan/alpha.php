<?php 
if (!$this->session->userdata('username')) {
	redirect('auth');
} else {
	?>

	<div class="container-fluid" id="container-wrapper">
		<div class="card mb-5" >
			<div class="card-header" style="background-color: mintcream">
				<div class="row">
					<div class="col-sm-6">
						<h3>ABSEN</h3>
					</div>
					<div class="col-sm-6 text-right">
						
					</div>
				</div>
			</div>
			<div class="card-body">
            <div class="row">
                <div class="col-md-8">
                <div class="alert alert-warning mt-4">Kamu Alpha Hari ini, Sayang Sekali</div>     
                </div>
                <div class="col-md-4">
                    <table class="mt-4">
                        <tr>
                            <th>Hari</th>
                            <td>:</td>
                            <td id="hari"></td>
                        </tr>
                        <tr>
                            <th>Jam</th>
                            <td>:</td>
                            <td id="watch"></td>
                        </tr>
                        <tr>
                            <th>Bulan</th>
                            <td>:</td>
                            <td id="bulan"></td>
                        </tr>
                        <tr>
                            <th>Tahun</th>
                            <td>:</td>
                            <td id="tahun"></td>
                        </tr>
                    </table>
                </div>
            </div>
		</div>
	</div>
</div>


<script>
    var now = new Date();
    const monthNames = ["0","January", "February", "March", "April", "May", "June",
                        "July", "August", "September", "October", "November", "December"
                        ];
    const dayNames = ["0","Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu","Minggu"
    ];

    function clock() {
        var now = new Date();
          var secs = ('0' + now.getSeconds()).slice(-2);
          var mins = ('0' + now.getMinutes()).slice(-2);
          var hr = now.getHours();
          var Time = hr + ":" + mins + ":" + secs;
          document.getElementById("watch").innerHTML = Time;
 

          requestAnimationFrame(clock);
        }

        requestAnimationFrame(clock);


    document.querySelector('#hari').innerHTML = dayNames[now.getDay()];
    document.querySelector('#bulan').innerHTML = monthNames[now.getMonth()];
    document.querySelector('#tahun').innerHTML = now.getFullYear();

  
</script>

<?php } ?>