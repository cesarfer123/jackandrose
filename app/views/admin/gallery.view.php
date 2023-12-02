<?php $this->view('admin/admin-header');?>
 
<?php if($action=='new'):?>

    <div class="col-md-6 mx-auto p-3">
        <h3>New Image</h3>
        <?php if(!empty($errors)): ?>
            <div class="alert alert-danger text-center"><?=implode("<br>",$errors)?></div>
        <?php endif; ?>
        <form enctype="multipart/form-data" method="post" class="text-center">
            <small>Click to chage image</small><br>
            <label >
                <input onchange="display_image(this.files[0],event)" type="file" name="image" class="d-none">
                <img src="<?=get_image();?>" style="width:300px;height:3 00px;object-fit:cover;cursor: pointer;">
            </label>
            <br>
            <button class="btn btn-primary my-4 float-start">Save</button>
            <a href="<?=ROOT?>admin/gallery">
                <button type="button" class="btn btn-secondary my-4 float-end">Back</button>
            </a>
        </form>
        <script>
            function display_image(file,e){
                let img=e.currentTarget.parentNode.querySelector('img');
                img.src=URL.createObjectURL(file);
            }
        </script>
    </div>
<?php elseif($action=='edit'): ?>

    <div class="col-md-6 mx-auto p-3">
        <h3>Editar User Record</h3>
        <?php if(!empty($errors)): ?>
            <div class="alert alert-danger text-center"><?=implode("<br>",$errors)?></div>
        <?php endif; ?>
        <?php if(!empty($row)): ?>
            <form enctype="multipart/form-data" method="post" class="text-center">
                <small>Click to chage image</small><br>
                <label >
                    <input onchange="display_image(this.files[0],event)" type="file" name="image" class="d-none">
                    <img src="<?=get_image($row->image);?>" style="width:300px;height:3 00px;object-fit:cover;cursor: pointer;">
                </label>
                <br>
                <button class="btn btn-primary my-4 float-start">Save</button>
                <a href="<?=ROOT?>admin/gallery">
                    <button type="button" class="btn btn-secondary my-4 float-end">Back</button>
                </a>
            </form>
            <script>
                function display_image(file,e){
                    let img=e.currentTarget.parentNode.querySelector('img');
                    img.src=URL.createObjectURL(file);
                }
            </script>
        <?php else: ?>

            <div class="alert alert-danger text-center">Record not found!</div>
            <a href="<?=ROOT?>admin/gallery">
                <button type="button" class="btn btn-secondary my-4 float-end">Back</button>
            </a>
        <?php endif; ?>
    </div>
<?php elseif($action=='delete'): ?>
    <div class="col-md-6 mx-auto p-3">
        <h3>Delete Image</h3>
        <?php if(!empty($errors)): ?>
            <div class="alert alert-danger text-center"><?=implode("<br>",$errors)?></div>
        <?php endif; ?>
        <?php if(!empty($row)): ?>
            <form method="post" class="text-center">
                <label >
                    <input onchange="display_image(this.files[0],event)" type="file" name="image" class="d-none">
                    <img src="<?=get_image($row->image);?>" style="width:300px;height:3 00px;object-fit:cover;cursor: pointer;">
                </label>
                <br>
                <button class="btn btn-danger my-4 float-start">Delete</button>
                <a href="<?=ROOT?>admin/gallery">
                    <button type="button" class="btn btn-secondary my-4 float-end">Back</button>
                </a>
            </form>

        <?php else: ?>

            <div class="alert alert-danger text-center">Record not found!</div>
            <a href="<?=ROOT?>admin/gallery">
                <button type="button" class="btn btn-secondary my-4 float-end">Back</button>
            </a>
        <?php endif; ?>
    </div>
<?php else: ?>
    <h3>
        Image Gallery 
        <a href="<?=ROOT?>admin/gallery/new">
            <button class="btn btn-primary">New</button>
        </a>
    </h3>
    <table class="table table-striped table-bordered">
        <tr>
            <th>#</th>
            <th>Images</th>
            <th>Action</th>
        </tr>

        <?php if(!empty($rows)):
                foreach ($rows as $row): ?>
                <tr>
                    <td><?=$row->id?></td>
                    <td><img src="<?=get_image($row->image)?>" style="width:200px;height:200px;object-fit:cover;"></td>
                    <td>
                        <a href="<?=ROOT?>admin/gallery/edit/<?=$row->id?>">
                            <button class="btn btn-primary">Edit</button>
                        </a>

                        <a href="<?=ROOT?>admin/gallery/delete/<?=$row->id?>">
                            <button class="btn btn-danger">Delete</button>
                        </a>
                    </td>  
                </tr>
        <?php    
                endforeach;
            endif;
        ?>
    </table>

<?php endif; ?>
<?php $this->view('admin/admin-footer'); ?>