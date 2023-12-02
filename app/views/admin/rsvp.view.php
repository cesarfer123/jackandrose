<?php $this->view('admin/admin-header');?>
 
<?php if($action=='delete'): ?>
    <div class="col-md-6 mx-auto p-3">
        <h3>Delete Rsvp</h3>
        <?php if(!empty($errors)): ?>
            <div class="alert alert-danger text-center"><?=implode("<br>",$errors)?></div>
        <?php endif; ?>
        <?php if(!empty($row)): ?>
            <form method="post" class="text-center">
                <div class="alert alert-danger">Are you sure you want to delete this record!?</div>
                <div class="form-control my-3"><?=old_value('name',esc($row->name))?></div>
                <div class="form-control my-3"><?=old_value('email',esc($row->email))?></div>
                <div class="form-control my-3"><?=old_value('message',esc($row->message))?></div>
                <br>
                <button class="btn btn-danger my-4 float-start">Delete</button>
                <a href="<?=ROOT?>admin/rsvp">
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
        RSVP List
    </h3>
    <table class="table table-striped table-bordered">
        <tr>
            <th>#</th>
            <th>Full Names</th>
            <th>Email</th>
            <th>Attending</th>
            <th>Number of Guests</th>
            <th>Message</th>
            <th>Action</th>
        </tr>

        <?php if(!empty($rows)):
                foreach ($rows as $row): ?>
                <tr>
                    <td><?=$row->id?></td>
                    <td><?=$row->name?></td>
                    <td><?=$row->email?></td>
                    <td><?=$row->attending?></td>
                    <td><?=$row->guests?></td>
                    <td><?=$row->message?></td>
                    <td>
                        <a href="<?=ROOT?>admin/rsvp/delete/<?=$row->id?>">
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