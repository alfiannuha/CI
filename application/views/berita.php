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
<h2>Data Berita</h2>
    <a href="<?php echo base_url().'index.php/berita/form/add'?>" class="btn btn-success"><i class="fa fa-plus"></i></a>
    <br> <br>
    <table id="example" class="display">
        <thead>
            <tr>
                <th>No.</th>
                <th>Judul</th>
                <th>Isi</th>
                <th>Tag</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            if(empty($qberita))
            {
                echo "Data Kosong";
            } else
            {
            $no=1;
            foreach($qberita as $rowberita)
            {
            ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $rowberita->judul ?></td>
                <td><?php echo $rowberita->isi ?></td>
                <td><?php echo $rowberita->tag ?></td>
                <td><?php echo $rowberita->tanggal ?></td>
                <td>
                    <a href="<?php echo base_url(); ?>index.php/berita/form/edit/<?php echo $rowberita->id ?>" 
                    class="btn btn-primary"><i class="fa fa-edit"></i></a>
                    <a href="<?php echo base_url(); ?>index.php/berita/hapus/<?php echo $rowberita->id ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            <?php
            $no++;
            }
        }
            ?>
        </tbody>
    </table>
</div>
