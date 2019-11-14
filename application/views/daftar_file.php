<script>
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            // 'copy', 'csv', 'excel', 'pdf', 'print'
            {
                extend: 'copy',
                exportOptions: {
                    columns: [0,1,2,3,4]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0,1,2,3,4]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0,1,2,3,4]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0,1,2,3,4]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0,1,2,3,4]
                }
            },
        ]
    } );
} );
</script>

<div class="container">
<h2>Daftar File</h2>
    <a href="<?php echo base_url().'index.php/upload/form_upload'?>" class="btn btn-success"><i class="fa fa-plus"></i></a>
    <br> <br>
    <table id="example" class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama File</th>
                <th>Size</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $no = null;
                $dir = "upload_file/";
                if(isset($daftar_file))
                {
                    for($a = 0;$a<count($daftar_file);$a++)
                    {
                        if($daftar_file[$a]!='.' && $daftar_file[$a]!='..')
                        {
                            $no++;
                            $file = $daftar_file[$a];
            ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $file; ?></td>
                <td><?php echo number_format(filesize($dir.$daftar_file[$a])/1024,2,',','.'); ?></td>
                <td><?php echo date('d-m-Y H:i:s',filemtime($dir.$daftar_file[$a])); ?></td>
                <td>
                    <a href="<?php echo base_url().$dir.$daftar_file[$a]; ?>" class="btn btn-primary"><i class="fa fa-download"></i></a>
                    <a href="<?php echo base_url().'index.php/upload/hapus/'.$daftar_file[$a]; ?>" class="btn btn-danger"><i class="fa fa-trash"></i>
            </tr>
        </tbody>
        <?php
              }
            }
        }
        ?>
    </table>
</div>

