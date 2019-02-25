<div class="main-content">
	<div class="section__content section__content--p30">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="col-md-12">
							<?=$this->session->flashdata('pesan')?>

							<div class="col-lg-12">
								<div class="card">
										<div class="card-header">
											<h4>Laporan Penerima </h4>
										</div>
										<div class="card-body">
											<div class="custom-tab">
	
												<nav>
													<div class="nav nav-tabs" id="nav-tab" role="tablist">

														<a class="nav-item nav-link active" id="custom-nav-perangkingan-tab" data-toggle="tab" href="#custom-nav-kriteria" role="tab" aria-controls="custom-nav-perangkingan"
														 aria-selected="true">Krieria</a>

														<a class="nav-item nav-link" id="custom-nav-kriteria-tab" data-toggle="tab" href="#custom-nav-subkriteria" role="tab" aria-controls="custom-nav-kriteria"
														 aria-selected="false">Sub Kriteria</a>

													
													</div>
												</nav>

												<div class="tab-content pl-3 pt-2" id="nav-tabContent">

													<div class="tab-pane fade show active" id="custom-nav-kriteria" role="tabpanel" aria-labelledby="custom-nav-perangkingan-tab">
														<!-- START KRITERIA -->
														<div class="row m-t-10">
															<div class="col-md-12">
																<h3 class="p-b-10">Kriteria</h3>
																<!-- <button type="button" class="btn btn-outline-secondary btn-sm" 
																					data-toggle="modal" data-placement="top" title="Ubah" data-target="#tambah">Tambah Kriteria</button> -->
																<div class="table-responsive m-b-40">
																	<table class="table table-hover">
																		<thead>
																			<tr class="bg-dark" style="color: #fff;">
																				<th>No</th>
																				<th>Nama</th>
																				<th>Keterangan</th>
																				<th>Sifat</th>
																				<th>Bobot</th>
																				<th>Aksi</th>
																			</tr>
																		</thead>
																		<tbody>
																		<?php $no =1; foreach($kriteria as $k){?>
																			<tr>
																				<td><?= $no ?></td>
																				<td><?= $k->nama ?></td>
																				<td><?= $k->keterangan ?></td>
																				<td><?= $k->sifat ?></td>
																				<td><?= $k->bobot ?></td>
																				<td>
																					<!-- <button type="button" class="btn btn-outline-secondary btn-sm btn_del" 																					
																					>Hapus</button> -->
																					<button type="button" class="btn btn-outline-secondary btn-sm"
																					data-toggle="modal" data-placement="top" title="ubah" data-target="#ubah<?= $k->id;?>">Ubah</button></td>
																			</tr>
																		<?php $no ++; }?>
																		</tbody>
																	</table>
																</div>
															</div>
														</div>
														<!-- END HASIL AKHIR -->
													</div>
												
													<!-- START END KRITERIA -->
													<div class="tab-pane fade" id="custom-nav-subkriteria" role="tabpanel" aria-labelledby="custom-nav-kriteria-tab">
															<!-- START SUB KRITERIA -->
															<div class="row m-t-10">
																	<div class="col-md-12">
																			
																			<!-- DATA TABLE KRITERIA-->
																			<?php 
																			$index ;
																			$i ;
																				for( $i =1; $i <= sizeof($subKriteria) ; $i++){
																					$index = 1;
																	?>
																			<div class="table-responsive m-b-40">
																			<h5 class="p-b-10">Sub Kriteria</h5>
																			<label for="selectSm" class=" form-control-label"><?= $subKriteria[$i][0]["subDari"] ?></label>
																					<table class="table table-hover">
																						
																							<thead>
																									<tr class="bg-dark" style="color: #fff;">
																											<th>NO</th>
																											<th>SUB</th>
																											<th>VALUE</th>
																											
																									</tr>
																							</thead>
																							<tbody>
																							<?php $no = 1;
																							foreach ($subKriteria[$i] as $data) 
																						{ ?>
																									<tr>
																									<td><?= $no?></td>
																									<td><?= $data["nama"]; ?></td>
																									<td><?= $data["value"]?></td>
																									
																								</tr>
																								<?php $no++;
																							}?>

																										
																							
																							</tbody>
																					</table>
																			</div>
																			<?php 
																		$index++;
																		}?>
																			
																			<!-- END DATA TABLE KRITERIA-->
																	</div>
															</div>
															<!-- END SUB KRITERIA -->
														
													</div>

													
												</div>
	
											</div>
										</div>
									</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="copyright">
						<p>
							Copyright © 2018 Colorlib. All rights reserved. Template by
							<a href="https://colorlib.com">Colorlib</a>.
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
    <!-- modal medium -->
    <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <form action="<?= base_url()?>index.php/Admin/simpan_kriteria" method="post" enctype="multipart/form-data" class="form-horizontal">
				<div class="modal-dialog modal-md" role="document">
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
                                                    <label for="text-input" class=" form-control-label">Nama</label>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <input type="text" id="text-input" name="nama" placeholder="misal : yatno" class="form-control">
                                                    <small class="form-text text-muted">Masukkan nama kriteria</small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Keterangan</label>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <input type="text" id="text-input" name="keterangan" placeholder="misal : 3" class="form-control">
                                                    <small class="form-text text-muted">Masukkan Untuk Kriteria</small>
                                                </div>
											</div>
											
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">Bobot</label>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <select name="bobot" id="select" class="form-control">
														<option value="0">Please select</option>
														<?php foreach ($bobot as $b) {?>
															 <option value="<?= $b->value; ?>"><?= $b->value; ?></option>
														<?php }?>

                                                    </select>
                                                </div>
											</div>
											<div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">Bobot</label>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <select name="sifat" id="select" class="form-control">
														<option value="0">Please select</option>
														<option value="benefit">benefit</option>
														<option value="cost">cost</option>
                                                    </select>
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
			 <?php foreach ($kriteria as $data) {?>
				<div class="modal fade" id="ubah<?= $data->id;?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    			<form action="<?= base_url()?>index.php/Admin/ubah_kriteria" method="post" enctype="multipart/form-data" class="form-horizontal">
				<div class="modal-dialog modal-md" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="mediumModalLabel">Tambahkan Data Penduduk</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<input type="hidden" name="id" value="<?= $data->id;?>">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Nama</label>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <input type="text" id="text-input" name="nama" placeholder="misal : yatno" class="form-control" value="<?= $data->nama;?>">
                                                    <small class="form-text text-muted">Masukkan nama kriteria</small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Keterangan</label>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <input type="text" id="text-input" name="keterangan" placeholder="misal : 3" class="form-control"  value="<?= $data->keterangan;?>">
                                                    <small class="form-text text-muted">Masukkan Untuk Kriteria</small>
                                                </div>
											</div>
											
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">Bobot</label>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <select name="bobot" id="select" class="form-control">
														<option value="<?= $data->bobot;?>"><?= $data->bobot;?></option>
														<?php foreach ($bobot as $b) {?>
															 <option value="<?= $b->value; ?>"><?= $b->value; ?></option>
														<?php }?>

                                                    </select>
                                                </div>
											</div>
											<div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">Bobot</label>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <select name="sifat" id="select" class="form-control">
														<option value="<?= $data->sifat;?>"><?= $data->sifat;?></option>
														<option value="benefit">benefit</option>
														<option value="cost">cost</option>
                                                    </select>
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

			 <?php } ?>
						 <!-- end modal medium -->
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
