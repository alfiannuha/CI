<?php
if($aksi=="aksi_add")
{
	$id="";
    $judul="";
    $isi="";
    $tag="";
}else{
    foreach($qberita as $rowberita)
    {
        $id=$rowberita->id;
        $judul=$rowberita->judul;
        $isi=$rowberita->isi;
        $tag=$rowberita->tag;
    }
}
?>
<script>
	tinymce.init({
		selector: '#isi'
	});

</script>

<div class="container">
	<div class="panel-heading">
		<h3 class="panel-title">Posting Berita</h3>
	</div>
	<form action="<?php echo base_url(); ?>index.php/berita/form/<?php echo $aksi; ?>" method="post" class="form-horizontal">
	<div class="form-group">
			<div class="col-md-7">
			<input type="text" name="id" placeholder="id" value="<?php echo $id; ?>" readonly hidden>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-md-3">Judul</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="judul" id="judul" placeholder="Judul" value="<?php echo $judul; ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-md-3">Isi</label>
			<div class="col-md-7">
				<textarea name="isi" class="form-control" id="isi" placeholder="Isi" ><?php echo $isi; ?></textarea>

			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-md-3">Tag</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="tag" placeholder="Tag" value="<?php echo $tag; ?>">
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-7 col-md-offset-3">
                <input type="submit" class="btn btn-primary" name="submit" value="
                <?php
                    if($aksi=="aksi_add")
                    {
                        echo "posting";
                    }else
                    {
                        echo "Update";
                    }

                ?>
                ">
			</div>
		</div>
	</form>
</div>
