<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                
                                    
                                    <div class="row">
                                    <div class="col-md-12">
                                    <?=$this->session->flashdata('pesan')?>
                                <!-- DATA TABLE -->
                                <h3 class="title-5 m-b-35">Data Penduduk</h3>
                                <div class="table-data__tool">
                                    <!-- <div class="table-data__tool-left">
                                        <div class="rs-select2--light rs-select2--md">
                                            <select class="js-select2" name="property">
                                                <option selected="selected">Jumlah tampil</option>
                                                <option value="">10</option>
                                                <option value="">20</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div class="rs-select2--light rs-select2--sm">
                                            <select class="js-select2" name="time">
                                                <option selected="selected">Today</option>
                                                <option value="">3 Days</option>
                                                <option value="">1 Week</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <button class="au-btn-filter">
                                            <i class="zmdi zmdi-filter-list"></i>filters</button>
                                    </div> -->
                                    <div class="table-data__tool-right">
                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#tambah">
                                            <i class="zmdi zmdi-plus"></i>Tambahkan Penduduk</button>
                                           
                                        <div class="rs-select2--dark rs-select2--sm rs-select2--dark2">
                                            <select class="js-select2" name="type">
                                                <option selected="selected">Expor</option>
                                                <option value="">Excel</option>
                                                <option value="">PDF</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive table-responsive-data2">
                                    <table class="table table-data2">
                                        <thead>
                                            <tr>
                                                <th>Nik</th>
                                                <th>Nama</th>
                                                <th>Tanggungan</th>
                                                <th>Alamat</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($penduduk as $data) { ?>
                                               
                                          
                                            <tr class="tr-shadow">
                                                                                               
                                                <td>
                                                    <span class="status--process"><?= $data->nik; ?></span>
                                                </td>
                                                <td><?= $data->nama; ?></td>
                                                <td><?= $data->tanggungan; ?></td>
                                                <td>
                                                    <span class="block-email"><?= $data->alamat; ?></span>
                                                </td>
                                                <td>
                                                    <div class="table-data-feature">
                                                       
                                                        <button class="item" data-toggle="modal" data-placement="top" title="Ubah" data-target="#ubah<?= $data->nik;?>">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                        <form action="<?= base_url()?>index.php/Admin/hapus_penduduk">
                                                        <button class="item btn_del"  type="submit" data-toggle="tooltip" data-placement="top" title="Hapus">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                        <input type="hidden" name="nik" value="<?= $data->nik?>">
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE -->
                            

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="copyright">
                        <p>Copyright © 2018 Colorlib. All rights reserved. Template by
                            <a href="https://colorlib.com">Colorlib</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- modal medium -->
    <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <form action="<?= base_url()?>index.php/Admin/tambah_penduduk" method="post" enctype="multipart/form-data" class="form-horizontal">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="mediumModalLabel">Tambahkan Data Penduduk</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
                       
                                           
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Nik</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="text-input" name="nik" placeholder="misal : 331xxxx" class="form-control">
                                                    <small class="form-text text-muted">Masukkan Nik Penduduk</small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Nama</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="text-input" name="nama" placeholder="misal : yatno" class="form-control">
                                                    <small class="form-text text-muted">Masukkan Nama Penduduk</small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Tanggungan</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="text-input" name="tanggungan" placeholder="misal : 3" class="form-control">
                                                    <small class="form-text text-muted">Masukkan Jumlah tanggungan</small>
                                                </div>
                                            </div>
                                            
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="textarea-input" class=" form-control-label">Alamat</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <textarea name="alamat" id="textarea-input" rows="4" placeholder="Alamat Penduduk" class="form-control"></textarea>
                                                </div>
                                            </div>
                                                                                 
                                          
                                  
                                        
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
							<button type="submit" class="btn btn-primary">Tambahkan</button>
						</div>
					</div>
                </div>
    </form>
	</div>
            <!-- end modal medium -->
            <!-- modal medium -->
            <?php foreach ($penduduk as $data) {?>
            <div class="modal fade" id="ubah<?= $data->nik;?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
            <form action="<?= base_url()?>index.php/Admin/ubah_penduduk" method="post" enctype="multipart/form-data" class="form-horizontal">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="mediumModalLabel">Ubah Data Penduduk</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
                                                              
                        <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Nik</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="text-input" value="<?= $data->nik;?>" disabled name="nik" placeholder="misal : 331xxxx" class="form-control">
                                                    <input type="hidden"  name="nik" value="<?= $data->nik;?>">
                                                    <small class="form-text text-muted">Masukkan Nik Penduduk</small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Nama</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="text-input" value="<?= $data->nama;?>" name="nama" placeholder="misal : yatno" class="form-control">
                                                    <small class="form-text text-muted">Masukkan Nama Penduduk</small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Tanggungan</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="text-input" value="<?= $data->tanggungan;?>" name="tanggungan" placeholder="misal : 3" class="form-control">
                                                    <small class="form-text text-muted">Masukkan Jumlah tanggungan</small>
                                                </div>
                                            </div>
                                            
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="textarea-input" class=" form-control-label">Alamat</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <textarea name="alamat" id="textarea-input" rows="4" placeholder="Alamat Penduduk" class="form-control"><?= $data->alamat;?></textarea>
                                                </div>
                                            </div>
                                  
                                        
						        </div>
						        <div class="modal-footer">
							        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
							        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
						        </div>
					        </div>
                        </div>
                </form>
			</div>
            <!-- end modal medium -->
            <?php }?>

            <div class="modal fade" id="modal_confirm_kriteria" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">System</h3>
				</div>
				<div class="modal-body">
					<center><h4>Are you sure you want to delete this data?</h4></center>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
					<button type="button" class="btn btn-success" id="btn_yes">Yes</button>
				</div>
			</div>
		</div>
	</div>