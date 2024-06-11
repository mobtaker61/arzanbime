<div>
    <h5>اطلاعات درخواست</h5>
    <div class="d-flex justify-content-evenly">
        <span class="btn btn-outline-primary mb-2"><strong>تلفن: </strong> <?php echo $quotation['tel']; ?></span>
        <span class="btn btn-outline-primary mb-2"><strong>تاریخ تولد: </strong> <?php echo $quotation['birth_date']; ?></span>
        <span class="btn btn-outline-primary mb-2"><strong>سن: </strong> <?php echo $quotation['age']; ?></span>
        <span class="btn btn-outline-primary mb-2"><strong>مدت: </strong> <?php echo $quotation['duration']; ?></span>
    </div>

    <?php if (!empty($followups)): ?>
        <div class="timeline"> <!-- timeline time label -->
            <div class="time-label"> <span class="text-bg-danger">تاریخچه پیگیری</span> </div> <!-- /.timeline-label -->
                <?php foreach ($followups as $followup): ?>
                    <!-- timeline item -->
                    <div>
                        <i class="timeline-icon bi bi-chat-text-fill text-bg-warning"></i>
                            <div class="timeline-item">
                                <span class="time"> <i class="bi bi-clock-fill"></i><?php echo $followup['date']; ?></span>
                                <h3 class="timeline-header"><?php echo $followup['responsible_user']; ?></h3>
                                <div class="timeline-body"><?php echo $followup['comment']; ?></div>
                                <div class="timeline-footer"> <span class="btn btn-warning btn-sm"><?php echo $followup['refer_to']; ?></span> </div>
                            </div>
                    </div> <!-- END timeline item -->
                <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-dark" role="alert">هنوز اقدامی روی این درخواست انجام نشده است</div>
    <?php endif; ?>
    </div>
</div>