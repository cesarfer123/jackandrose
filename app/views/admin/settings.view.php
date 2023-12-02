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

            <input value="<?=old_value('setting')?>" type="text" name="setting" class="form-control mb-3" placeholder="Setting name">
            <select name="type" class="form-select mb-3">
                <option <?=old_select('type','text')?> value="text">Text</option>
                <option <?=old_select('type','image')?> value="image">Image</option>
                <option <?=old_select('type','number')?> value="number">Number</option>
            </select>
            <br>
            <button class="btn btn-primary my-4 float-start">Save</button>
            <a href="<?=ROOT?>admin/settings">
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
        <h3>Editar Setting</h3>
        <?php if(!empty($errors)): ?>
            <div class="alert alert-danger text-center"><?=implode("<br>",$errors)?></div>
        <?php endif; ?>
        <?php if(!empty($row)): ?>
            <form enctype="multipart/form-data" method="post" class="text-center">

                <input value="<?=old_value('setting',$row->setting)?>" type="text" name="setting" class="form-control mb-3" placeholder="Setting name">
                <?php if($row->type=="image"): ?>
                    <label>Click to change image</label>
                    <br>
                    <label >
                        <input onchange="display_image(this.files[0],event)" type="file" name="image" class="d-none">
                        <img src="<?=get_image($row->value);?>" style="width:300px;height:3 00px;object-fit:cover;cursor: pointer;">
                    </label>
                <?php else: ?>
                    <input value="<?=old_value('value',$row->value)?>" type="text" name="value" class="form-control mb-3" placeholder="Setting Value">
                <?php endif; ?>
                <br>
                <button class="btn btn-primary my-4 float-start">Save</button>
                <a href="<?=ROOT?>admin/settings">
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
            <a href="<?=ROOT?>admin/settings">
                <button type="button" class="btn btn-secondary my-4 float-end">Back</button>
            </a>
        <?php endif; ?>
    </div>
<?php elseif($action=='delete'): ?>
    <div class="col-md-6 mx-auto p-3">
        <h3>Delete Setting</h3>
        <?php if(!empty($errors)): ?>
            <div class="alert alert-danger text-center"><?=implode("<br>",$errors)?></div>
        <?php endif; ?>
        <?php if(!empty($row)): ?>
            <form method="post" class="text-center">

                <div class="form-control my-3"><?=old_value('setting',esc($row->setting))?></div>
                <?php if($row->image=="image"): ?>
                    <label >
                        <input onchange="display_image(this.files[0],event)" type="file" name="image" class="d-none">
                        <img src="<?=get_image($row->image);?>" style="width:300px;height:3 00px;object-fit:cover;cursor: pointer;">
                    </label>
                <?php else: ?>
                        <div class="form-control my-3"><?=old_value('value',esc($row->value))?></div>
                <?php endif; ?>
                <br>
                <button class="btn btn-danger my-4 float-start">Delete</button>
                <a href="<?=ROOT?>admin/settings">
                    <button type="button" class="btn btn-secondary my-4 float-end">Back</button>
                </a>
            </form>

        <?php else: ?>

            <div class="alert alert-danger text-center">Record not found!</div>
            <a href="<?=ROOT?>admin/settings">
                <button type="button" class="btn btn-secondary my-4 float-end">Back</button>
            </a>
        <?php endif; ?>
    </div>
<?php else: ?>
    <h3>
        Setting
        <a href="<?=ROOT?>admin/settings/new">
            <button class="btn btn-primary">New</button>
        </a>
    </h3>
    <table class="table table-striped table-bordered">
        <tr>
            <th>#</th>
            <th>Setting</th>
            <th>Type</th>
            <th>Value</th>
            <th>Action</th>
        </tr>

        <?php if(!empty($rows)):
                foreach ($rows as $row): ?>
                <tr>
                    <td><?=$row->id?></td>
                    <td><?=$row->setting?></td>
                    <td><?=$row->type?></td>
                    <?php if($row->type=="image"): ?>
                        <td><img src="<?=get_image($row->value)?>" style="width:200px;height:200px;object-fit:cover;"></td>
                    <?php else: ?>
                        <td><?=$row->value?></td>
                    <?php endif; ?>
                    <td>
                        <a href="<?=ROOT?>admin/settings/edit/<?=$row->id?>">
                            <button class="btn btn-primary">Edit</button>
                        </a>

                        <a href="<?=ROOT?>admin/settings/delete/<?=$row->id?>">
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