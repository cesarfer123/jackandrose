<?php $this->view('admin/admin-header'); ?>
    <h3>Dashboard</h3>
    <div class="row">
        <div class="m-4 p-2 shadow text-center col-md-4 border rounded">
            <i class="fs-1 fa fa-users"></i>
            <h1>Users</h1>
            <h3><?=$total_users->total?></h3>
        </div>
        <div class="m-4 p-2 shadow text-center col-md-4 border rounded">
            <i class="fs-1 fa fa-images"></i>
            <h1>Gallery Images</h1>
            <h3><?=$total_images->total?></h3>
        </div>
        <div class="m-4 p-2 shadow text-center col-md-4 border rounded">
            <i class="fs-1 fa fa-envelope"></i>
            <h1>Rsvp Count</h1>
            <h3><?=$total_rsvp->total?></h3>
        </div>
    </div>
<?php $this->view('admin/admin-footer'); ?>