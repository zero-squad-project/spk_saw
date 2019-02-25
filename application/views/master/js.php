<!-- Jquery JS-->
    <script src="<?= base_url(); ?>assets/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="<?= base_url(); ?>assets/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="<?= base_url(); ?>assets/vendor/slick/slick.min.js">
    </script>
    <script src="<?= base_url(); ?>assets/vendor/wow/wow.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/animsition/animsition.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="<?= base_url(); ?>assets/vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="<?= base_url(); ?>assets/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="<?= base_url(); ?>assets/js/main.js"></script>
    <script type="text/javascript">
    //hapus kriteria
//     $(document).ready(function(){
// 	    $('.btn_del').on('click', function(){
// 		    var kritria_id = $(this).attr('id');
// 		    $("#modal_confirm_kriteria").modal('show');
// 		    $('#btn_yes').attr('name', stud_id);
// 	    });
// 	$('#btn_yes').on('click', function(){
// 		var id = $(this).attr('name');
// 		$.ajax({
// 			type: "POST",
// 			url: "<?= base_url()?>index.php/Admin/hapus_kriteria",
// 			data:{
// 				kriteria_id: id
// 			},
// 			success: function(){
// 				$("#modal_confirm").modal('hide');
// 				$(".del_stud" + id).empty();
// 				$(".del_stud" + id).html("<td colspan='5'><center>Deleting...</center></td>");
// 				setTimeout(function(){
// 					$(".del_stud" + id).fadeOut('slow');
// 				}, 1000);
// 			}
// 		});
// 	});
// });
//hapus penduduk
$(document).ready(function(){
	    $('.btn_del').on('click', function(){
		    var nik = $(this).attr('id');
		    $("#modal_confirm_penduduk").modal('show');
		    $('#btn_yes').attr('name', nik);
	    });
	$('#btn_yes').on('click', function(){
		var id = $(this).attr('name');
		$.ajax({
			type: "POST",
			url: "<?= base_url()?>index.php/Admin/hapus_penduduk",
			data:{
				nik: id
				}
			// },
			// success: function(){
			// 	$("#modal_confirm_penduduk").modal('hide');
			// 	$(".del_stud" + id).empty();
			// 	$(".del_stud" + id).html("<td colspan='5'><center>Deleting...</center></td>");
			// 	setTimeout(function(){
			// 		$(".del_stud" + id).fadeOut('slow');
			// 	}, 1000);
			// }
		});
	});
});
//hapus pegawai
// $(document).ready(function(){
// 	    $('.btn_del').on('click', function(){
// 		    var stud_id = $(this).attr('id');
// 		    $("#modal_confirm_pegawai").modal('show');
// 		    $('#btn_yes').attr('name', stud_id);
// 	    });
// 	$('#btn_yes').on('click', function(){
// 		var id = $(this).attr('name');
// 		$.ajax({
// 			type: "POST",
// 			url: "<?= base_url()?>index.php/Admin/hapus_kriteria",
// 			data:{
// 				stud_id: id
// 			},
// 			success: function(){
// 				$("#modal_confirm").modal('hide');
// 				$(".del_stud" + id).empty();
// 				$(".del_stud" + id).html("<td colspan='5'><center>Deleting...</center></td>");
// 				setTimeout(function(){
// 					$(".del_stud" + id).fadeOut('slow');
// 				}, 1000);
// 			}
// 		});
// 	});
// });
</script>
