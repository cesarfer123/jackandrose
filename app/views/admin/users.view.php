<?php $this->view('admin/admin-header');?>
 
<?php if($action=='new'):?>

    <div class="col-md-6 mx-auto p-3">
        <h3>New User Record</h3>
        <?php if(!empty($errors)): ?>
            <div class="alert alert-danger text-center"><?=implode("<br>",$errors)?></div>
        <?php endif; ?>
        <form method="post">
            <input value="<?=old_value('username');?>" type="text" class="form-control mt-3" name="username" placeholder="Username">
            <input value="<?=old_value('email');?>" type="email" class="form-control mt-3" name="email" placeholder="Email">
            <input value="<?=old_value('password');?>" type="text" class="form-control mt-3" name="password" placeholder="Password">
            <button class="btn btn-primary my-4">Save</button>
            <a href="<?=ROOT?>admin/users">
                <button type="button" class="btn btn-secondary my-4 float-end">Back</button>
            </a>
        </form>
    </div>
<?php elseif($action=='edit'): ?>

    <div class="col-md-6 mx-auto p-3">
        <h3>Editar User Record</h3>
        <?php if(!empty($errors)): ?>
            <div class="alert alert-danger text-center"><?=implode("<br>",$errors)?></div>
        <?php endif; ?>
        <?php if(!empty($row)): ?>
            <form method="post">
                <input value="<?=old_value('username',$row->username);?>" type="text" class="form-control mt-3" name="username" placeholder="Username">
                <input value="<?=old_value('email',$row->email);?>" type="email" class="form-control mt-3" name="email" placeholder="Email">
                <input value="<?=old_value('password');?>" type="text" class="form-control mt-3" name="password" placeholder="Dejar vacio si no quieres cambiar">
                <button class="btn btn-primary my-4">Save</button>
                <a href="<?=ROOT?>admin/users">
                    <button type="button" class="btn btn-secondary my-4 float-end">Back</button>
                </a>
            </form>

        <?php else: ?>

            <div class="alert alert-danger text-center">Record not found!</div>
            <a href="<?=ROOT?>admin/users">
                <button type="button" class="btn btn-secondary my-4 float-end">Back</button>
            </a>
        <?php endif; ?>
    </div>
<?php elseif($action=='delete'): ?>
    <div class="col-md-6 mx-auto p-3">
        <h3>Delete User Record</h3>
        <?php if(!empty($errors)): ?>
            <div class="alert alert-danger text-center"><?=implode("<br>",$errors)?></div>
        <?php endif; ?>
        <?php if(!empty($row)): ?>
            <form method="post">
                <div class="form-control mt-3"><?=old_value('username',$row->username);?></div>
                <div class="form-control mt-3"><?=old_value('username',$row->email);?></div>
                <button class="btn btn-danger my-4">Delete</button>
                <a href="<?=ROOT?>admin/users">
                    <button type="button" class="btn btn-secondary my-4 float-end">Back</button>
                </a>
            </form>

        <?php else: ?>

            <div class="alert alert-danger text-center">Record not found!</div>
            <a href="<?=ROOT?>admin/users">
                <button type="button" class="btn btn-secondary my-4 float-end">Back</button>
            </a>
        <?php endif; ?>
    </div>
<?php else: ?>
    <h3>
        Users 
        <a href="<?=ROOT?>admin/users/new">
            <button class="btn btn-primary">New</button>
        </a>
    </h3>
    <table class="table table-striped table-bordered">
        <tr>
            <th>#</th>
            <th>Username</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>

        <?php if(!empty($rows)):
                foreach ($rows as $row): ?>
                <tr>
                    <td><?=$row->id?></td>
                    <td><?=$row->username?></td>
                    <td><?=$row->email?></td>
                    <td>
                        <a href="<?=ROOT?>admin/users/edit/<?=$row->id?>">
                            <button class="btn btn-primary">Edit</button>
                        </a>

                        <a href="<?=ROOT?>admin/users/delete/<?=$row->id?>">
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