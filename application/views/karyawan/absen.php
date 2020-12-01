<?php
if (!$this->session->userdata('username')) {
    redirect('auth');
} else {
?>

    <div class="container-fluid" id="container-wrapper">
        <div class="card mb-5">
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
                    <div class="col-md-8" id="box-absen">
                        <?php if ($checkAbsen === 'sudah') { ?>
                            <div class="alert alert-success mt-4">Selamat Beristirahat</div>
                        <?php } else { ?>
                            <?php if ($checkStatus === "kosong") { ?>
                                <form id="<?= ($checkAbsen === 'keluar' ? 'form_keluar' : 'form_masuk') ?>">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input id="nama" readonly required="" type="text" class="form-control">
                                            <script>
                                                document.querySelector('#nama').value = "<?= $this->session->userdata('nama') ?>";
                                            </script>
                                        </div>
                                        <?php if ($checkAbsen != 'keluar') { ?>
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select required name="status" id="status" class="form-control">
                                                    <option value="" disabled selected hidden>Pilih Status</option>
                                                    <option value="masuk">masuk</option>
                                                    <option value="ijin">ijin</option>
                                                    <option value="sakit">sakit</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Keterangan</label>
                                                <textarea rows="3" name="keterangan" class="form-control"></textarea>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Absen <?= ($checkAbsen === 'keluar' ? 'Keluar' : 'Masuk') ?></button>
                                    </div>
                                </form>
                            <?php } else { ?>
                                <?php if ($checkStatus->status === "ijin") {  ?>
                                    <div class="alert alert-success mt-4">Ok baik</div>
                                <?php } else if ($checkStatus->status === "sakit") { ?>
                                    <div class="alert alert-success mt-4">Semoga Cepat Sembuh</div>
                                <?php } else { ?>
                                    <form id="<?= ($checkAbsen === 'keluar' ? 'form_keluar' : 'form_masuk') ?>">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input id="nama" readonly required="" type="text" class="form-control">
                                            </div>
                                            <script>
                                                document.querySelector('#nama').value = "<?= $this->session->userdata('nama') ?>";
                                            </script>
                                            <?php if ($checkAbsen != 'keluar') { ?>
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select required name="status" id="status" class="form-control">
                                                        <option value="" disabled selected hidden>Pilih Status</option>
                                                        <option value="masuk">masuk</option>
                                                        <option value="ijin">ijin</option>
                                                        <option value="sakit">sakit</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Keterangan</label>
                                                    <textarea rows="3" name="keterangan" class="form-control"></textarea>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Absen <?= ($checkAbsen === 'keluar' ? 'Keluar' : 'Masuk') ?></button>
                                        </div>
                                    </form>
                                <?php } ?>
                            <?php  } ?>
                        <?php  } ?>

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


    <!-- Modal tambah-->
    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            </div>
        </div>
    </div>
    <!-- end -->


    <script>
        var now = new Date();
        const monthNames = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];
        const dayNames = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"];

        function clock() {
            var now = new Date();
            var secs = ('0' + now.getSeconds()).slice(-2);
            var mins = ('0' + now.getMinutes()).slice(-2);
            var hr = now.getHours();
            var Time = hr + ":" + mins + ":" + secs;
            document.getElementById("watch").innerHTML = Time;
            //   let compere = "07:30:00";
            //   if(Time > compere){

            //     $('#box-absen').html(`<div class="alert alert-warning mt-4">Kamu Alpha Hari ini, Sayang Sekali</div>   `)

            //   }

            requestAnimationFrame(clock);
        }

        requestAnimationFrame(clock);


        document.querySelector('#hari').innerHTML = dayNames[now.getDay()];
        document.querySelector('#bulan').innerHTML = monthNames[now.getMonth()];
        document.querySelector('#tahun').innerHTML = now.getFullYear();

        //ajax untuk absen masuk
        $(document).on('submit', '#form_masuk', function(e) {
            e.preventDefault();
            const data = $('#<?= ($checkAbsen === 'keluar' ? 'form_keluar' : 'form_masuk') ?>').serialize() + "&masuk=true";

            $.ajax({
                url: base_url + "Karyawan/aksiAbsen",
                data: data,
                type: 'POST',
                dataType: "JSON",
                success: function(result) {

                    if (result.create == true) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil...',
                            text: 'Selamat Anda Berhasil Absen!',
                        })
                        setTimeout(() => {
                            location.reload();
                        }, 1000)
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Maaf Anda Gagal Absen!',
                        })
                    }
                }
            })
        })

        //ajax untuk absen keluar
        $(document).on('submit', '#form_keluar', function(e) {
            e.preventDefault();
            const data = $('#<?= ($checkAbsen === 'keluar' ? 'form_keluar' : 'form_masuk') ?>').serialize() + "&keluar=true";
            $.ajax({
                url: base_url + "Karyawan/aksiAbsen",
                data: data,
                type: 'POST',
                dataType: "JSON",
                success: function(result) {
                    if (result.edit == true) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil...',
                            text: 'Selamat Anda Berhasil Absen!',
                        })
                        setTimeout(() => {
                            location.reload();
                        }, 1000)
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Maaf Anda Gagal Absen!',
                        })
                    }
                }
            })
        })
    </script>

<?php } ?>