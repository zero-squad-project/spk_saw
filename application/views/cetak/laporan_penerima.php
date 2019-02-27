<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?= $title ?></title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/tabel.css" >
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="author" content="Willy" />
        <style>
            body, h2 {
                font-family: "Courier new";
            }
            h2,h3{
                margin-bottom: 5px;
                margin-top: 0px;
            }
            .garis{
                height: 2px;
                background-color: #000;
                margin-bottom: 0px;
                margin-top: 10px;
            }
            hr{
                height: 0.5px;
                background-color: #000;
                margin-top: 5px;
            }

        </style>

        <script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/jquery-3.2.1.min.js"></script>

    </head>

    <body style="font-family: 'Courier';">
        <div class="container">
            <div align="center" style="margin-top: 20px;">
                <h2 align="center" style="font-family: 'Courier';">LAPORAN</h2>
                <!-- <h2 align="center" style="font-family: 'Courier';">PERIODE <?= $periode->nama ?></h2> -->
                <h3 align="center">LAPORAN PER <?= strtoupper(date('M Y')); ?></h3>
                <hr class="garis"/>
                <hr/>
            </div>
            <div class="right" align='right' style="margin-top: 0px;"><b><p><?php echo $tgl; ?></p></b></div>

            <table class="table table-striped">
                <thead>
                    <th scope="col">No</th>
                    <th scope="col">NIK</th>
                    <th scope="col">NAMA</th>
                    <th scope="col">STATUS</th>
                </thead>
                <?php
                $no = 1;
                $i = 0;
                    foreach ($penduduk as $key) {
                        ?>
                        <tr>
                            <th scope="row"><?php echo $no++ ?></th>
                            <td><?php echo $key['nik'] ?></td>
                            <td><?php echo $key['nama'] ?></td>
                            <td><?php echo $key['status'] ?></td>
                        </tr>
                        <?php
                        $i++;
                    }
                ?>            
            </table>
        </div>	
    </body>
</html>
<script>
    $('table').each(function () {
        $(this).find('thead').find('th').addClass('center');
    });
</script>