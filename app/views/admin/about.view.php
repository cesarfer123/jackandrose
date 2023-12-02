<?php $this->view('admin/admin-header');?>
 
<?php if($action=='new'):?>

    <div class="col-md-6 mx-auto p-3">
        <center>
            <h3>New about Member</h3>
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
            <input value="<?=old_value('title')?>" type="text" name="title" class="form-control mb-3" placeholder="Title">
            <input value="<?=old_value('icon')?>" type="text" name="icon" class="form-control mb-3" placeholder="Icon">
            <input value="<?=old_value('name')?>" type="text" name="name" class="form-control mb-3" placeholder="Person´s Name">
            <textarea name="description" class="form-control mb-3" placeholder="Description" cols="30" rows="10"><?=old_value('description')?></textarea>         
            <hr>
            <input value="<?=old_value('twitter_link')?>" type="text" name="twitter_link" class="form-control mb-3" placeholder="Twitter Link">
            <input value="<?=old_value('facebook_link')?>" type="text" name="facebook_link" class="form-control mb-3" placeholder="Facebook Link">
            <input value="<?=old_value('instagram_link')?>" type="text" name="instagram_link" class="form-control mb-3" placeholder="Instagram Link">
            <input value="<?=old_value('linkedin_link')?>" type="text" name="linkedin_link" class="form-control mb-3" placeholder="Linked in Link">
            <hr>
            <label class="text-start d-block">List Order:</label>
            <input value="<?=old_value('list_order',0)?>" type="number" min="0" name="list_order" class="form-control mb-3">
            
            <br>
            <button class="btn btn-primary my-4 float-start">Save</button>
            <a href="<?=ROOT?>admin/about">
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
        <h3>Editar about Record</h3>
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
                <input value="<?=old_value('title',$row->title)?>" type="text" name="title" class="form-control mb-3" placeholder="Title">
                <input value="<?=old_value('icon',$row->icon)?>" type="text" name="icon" class="form-control mb-3" placeholder="Icon">
                <input value="<?=old_value('name',$row->name)?>" type="text" name="name" class="form-control mb-3" placeholder="Person´s Name">
                <textarea name="description" class="form-control mb-3" placeholder="Description" cols="30" rows="10"><?=old_value('description',$row->description)?></textarea>         
                <hr>
                <input value="<?=old_value('twitter_link',$row->twitter_link)?>" type="text" name="twitter_link" class="form-control mb-3" placeholder="Twitter Link">
                <input value="<?=old_value('facebook_link',$row->facebook_link)?>" type="text" name="facebook_link" class="form-control mb-3" placeholder="Facebook Link">
                <input value="<?=old_value('instagram_link',$row->instagram_link)?>" type="text" name="instagram_link" class="form-control mb-3" placeholder="Instagram Link">
                <input value="<?=old_value('linkedin_link',$row->linkedin_link)?>" type="text" name="linkedin_link" class="form-control mb-3" placeholder="Linked in Link">
                <hr>
                <label class="text-start d-block">List Order:</label>
                <input value="<?=old_value('list_order',0)?>" type="number" min="0" name="list_order" class="form-control mb-3">
                
                <br>
                
                <button class="btn btn-primary my-4 float-start">Save</button>
                <a href="<?=ROOT?>admin/about">
                    <button type="button" class="btn btn-secondary my-4 float-end">Back</button>
                </a>
            </form>
            <script>
                function display_image(file,e){
                    let img=e.currentTarget.parentNode.querySelector('img');
                    img.src=URL.createObjectURL(file);
                }
                document.querySelector(".mydate").valueAsDate= Date('<?=old_value('date',$row->date)?>');
            </script>
        <?php else: ?>

            <div class="alert alert-danger text-center">Record not found!</div>
            <a href="<?=ROOT?>admin/about">
                <button type="button" class="btn btn-secondary my-4 float-end">Back</button>
            </a>
        <?php endif; ?>
    </div>
<?php elseif($action=='delete'): ?>
    <div class="col-md-6 mx-auto p-3">
        <h3>Delete about</h3>
        <?php if(!empty($errors)): ?>
            <div class="alert alert-danger text-center"><?=implode("<br>",$errors)?></div>
        <?php endif; ?>
        <?php if(!empty($row)): ?>
            <form method="post" class="text-center">
                <div class="alert alert-danger">Are you sure you want to delete this record!?</div>
                <label >
                    <input onchange="display_image(this.files[0],event)" type="file" name="image" class="d-none">
                    <img src="<?=get_image($row->image);?>" style="width:300px;height:3 00px;object-fit:cover;cursor: pointer;">
                </label>
                <div class="form-control my-3"><?=old_value('title',esc($row->title))?></div>
                <br>
                <button class="btn btn-danger my-4 float-start">Delete</button>
                <a href="<?=ROOT?>admin/about">
                    <button type="button" class="btn btn-secondary my-4 float-end">Back</button>
                </a>
            </form>

        <?php else: ?>

            <div class="alert alert-danger text-center">Record not found!</div>
            <a href="<?=ROOT?>admin/about">
                <button type="button" class="btn btn-secondary my-4 float-end">Back</button>
            </a>
        <?php endif; ?>
    </div>
<?php else: ?>
    <h3>
        About Gallery
        <a href="<?=ROOT?>admin/about/new">
            <button class="btn btn-primary">New</button>
        </a>
    </h3>
    <table class="table table-striped table-bordered">
        <tr>
            <th>#</th>
            <th>Image</th>
            <th>About Title</th>
            <th>Person's Name</th>
            <th>Icon</th>
            <th>Description</th>
            <th>List Order</th>
            <th>Action</th>
        </tr>

        <?php if(!empty($rows)):
                foreach ($rows as $row): ?>
                <tr>
                    <td><?=$row->id?></td>
                    <td><img src="<?=get_image($row->image)?>" style="width:200px;height:200px;object-fit:cover;"></td>
                    <td><?=$row->title?></td>
                    <td><?=$row->name?></td>
                    <td><i class="fs-1 fa fa-<?=$row->icon?>"></i></td>
                    <td><?=$row->description?></td>
                    <td><?=$row->list_order?></td>
                    <td>
                        <a href="<?=ROOT?>admin/about/edit/<?=$row->id?>">
                            <button class="btn btn-primary">Edit</button>
                        </a>

                        <a href="<?=ROOT?>admin/about/delete/<?=$row->id?>">
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