<?php $this->view('admin/admin-header');?>
 
<?php if($action=='new'):?>

    <div class="col-md-6 mx-auto p-3">
        <center>
            <h3>New Family Member</h3>
        </center>
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
            <input value="<?=old_value('name')?>" type="text" name="name" class="form-control mb-3" placeholder="Full name">
            <input value="<?=old_value('title')?>" type="text" name="title" class="form-control mb-3" placeholder="Title">
            <label class="text-start d-block">List Order:</label>
            <input value="<?=old_value('list_order',0)?>" type="number" min="0" name="list_order" class="form-control mb-3">
            
            <hr>
            <input value="<?=old_value('twitter_link')?>" type="text" name="twitter_link" class="form-control mb-3" placeholder="Twitter Link">
            <input value="<?=old_value('facebook_link')?>" type="text" name="facebook_link" class="form-control mb-3" placeholder="Facebook Link">
            <input value="<?=old_value('instagram_link')?>" type="text" name="instagram_link" class="form-control mb-3" placeholder="Instagram Link">
            <input value="<?=old_value('linkedin_link')?>" type="text" name="linkedin_link" class="form-control mb-3" placeholder="Linked in Link">
            <br>
            <button class="btn btn-primary my-4 float-start">Save</button>
            <a href="<?=ROOT?>admin/family">
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
        <h3>Editar Family Record</h3>
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
                <input value="<?=old_value('name',$row->name)?>" type="text" name="name" class="form-control mb-3" placeholder="Full name">
                <input value="<?=old_value('title',$row->title)?>" type="text" name="title" class="form-control mb-3" placeholder="Title">
                
                <label class="text-start d-block">List Order:</label>
                <input value="<?=old_value('list_order',$row->list_order)?>" type="number" min="0" name="list_order" class="form-control mb-3">
                
                <hr>
                <input value="<?=old_value('twitter_link',$row->twitter_link)?>" type="text" name="twitter_link" class="form-control mb-3" placeholder="Twitter Link">
                <input value="<?=old_value('facebook_link',$row->facebook_link)?>" type="text" name="facebook_link" class="form-control mb-3" placeholder="Facebook Link">
                <input value="<?=old_value('instagram_link',$row->instagram_link)?>" type="text" name="instagram_link" class="form-control mb-3" placeholder="Instagram Link">
                <input value="<?=old_value('linkedin_link',$row->linkedin_link)?>" type="text" name="linkedin_link" class="form-control mb-3" placeholder="Linked in Link">
                <br>
                <button class="btn btn-primary my-4 float-start">Save</button>
                <a href="<?=ROOT?>admin/family">
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
            <a href="<?=ROOT?>admin/family">
                <button type="button" class="btn btn-secondary my-4 float-end">Back</button>
            </a>
        <?php endif; ?>
    </div>
<?php elseif($action=='delete'): ?>
    <div class="col-md-6 mx-auto p-3">
        <h3>Delete Family</h3>
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
                <a href="<?=ROOT?>admin/family">
                    <button type="button" class="btn btn-secondary my-4 float-end">Back</button>
                </a>
            </form>

        <?php else: ?>

            <div class="alert alert-danger text-center">Record not found!</div>
            <a href="<?=ROOT?>admin/family">
                <button type="button" class="btn btn-secondary my-4 float-end">Back</button>
            </a>
        <?php endif; ?>
    </div>
<?php else: ?>
    <h3>
        Family Member Gallery
        <a href="<?=ROOT?>admin/family/new">
            <button class="btn btn-primary">New</button>
        </a>
    </h3>
    <table class="table table-striped table-bordered">
        <tr>
            <th>#</th>
            <th>Image</th>
            <th>Family Member</th>
            <th>Title</th>
            <th>List Order</th>
            <th>Action</th>
        </tr>

        <?php if(!empty($rows)):
                foreach ($rows as $row): ?>
                <tr>
                    <td><?=$row->id?></td>
                    <td><img src="<?=get_image($row->image)?>" style="width:200px;height:200px;object-fit:cover;"></td>
                    <td><?=$row->name?></td>
                    <td><?=$row->title?></td>
                    <td><?=$row->list_order?></td>
                    <td>
                        <a href="<?=ROOT?>admin/family/edit/<?=$row->id?>">
                            <button class="btn btn-primary">Edit</button>
                        </a>

                        <a href="<?=ROOT?>admin/family/delete/<?=$row->id?>">
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