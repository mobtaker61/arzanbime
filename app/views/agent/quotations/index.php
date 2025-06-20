<?php
$pagetitle = "Quotations";
?>

<section class="pady">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Quotations</h3>
            <div class="card-tools">
                <a href="/agent/quotations/create" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> New Quotation
                </a>
            </div>
        </div>
        <div class="card-body">
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Client</th>
                            <th>Age</th>
                            <th>Duration</th>
                            <th>Package</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($quotations as $quotation): ?>
                            <tr>
                                <td><?php echo $quotation['id']; ?></td>
                                <td>
                                    <?php echo $quotation['client_name'] . ' ' . $quotation['client_family']; ?>
                                    <br>
                                    <small class="text-muted">ID: <?php echo $quotation['client_id_no']; ?></small>
                                </td>
                                <td><?php echo $quotation['age']; ?></td>
                                <td><?php echo $quotation['duration']; ?> Year(s)</td>
                                <td>
                                    <?php echo $quotation['package_name']; ?>
                                    <br>
                                    <small class="text-muted"><?php echo $quotation['company_name']; ?></small>
                                </td>
                                <td>
                                    <span class="badge badge-<?php 
                                        echo $quotation['status'] === 'pending' ? 'warning' : 
                                            ($quotation['status'] === 'approved' ? 'success' : 'danger'); 
                                    ?>">
                                        <?php echo ucfirst($quotation['status']); ?>
                                    </span>
                                </td>
                                <td><?php echo date('Y-m-d H:i', strtotime($quotation['created_at'])); ?></td>
                                <td>
                                    <a href="/agent/quotations/view/<?php echo $quotation['id']; ?>" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section> 