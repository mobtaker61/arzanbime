<div class="col-md-6">
    <div class="d-flex justify-content-evenly">
        <span class="btn btn-outline-primary mb-2"><strong>تلفن: </strong> <?php echo $quotation['tel']; ?></span>
        <span class="btn btn-outline-primary mb-2"><strong>تاریخ تولد: </strong> <?php echo $quotation['birth_date']; ?></span>
        <span class="btn btn-outline-primary mb-2"><strong>سن: </strong> <?php echo $quotation['age']; ?></span>
        <span class="btn btn-outline-primary mb-2"><strong>مدت: </strong> <?php echo $quotation['duration']; ?></span>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Package ID</th>
                <th>Age</th>
                <th>First Year</th>
                <th>Second Year</th>
                <th>Two Year</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tariffs as $tariff) : ?>
                <tr>
                    <td><?php echo $tariff['package_id']; ?></td>
                    <td><?php echo $tariff['age']; ?></td>
                    <td><?php echo $tariff['first_year']; ?></td>
                    <td><?php echo $tariff['second_year']; ?></td>
                    <td><?php echo $tariff['two_year']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="col-md-6">
    <?php if (!empty($followups)) : ?>
        <div class="timeline">
            <div class="time-label"> <span class="text-bg-danger">تاریخچه پیگیری</span> </div>
            <?php foreach ($followups as $followup) : ?>
                <div>
                    <i class="timeline-icon bi bi-chat-text-fill text-bg-warning"></i>
                    <div class="timeline-item">
                        <span class="time"> <i class="bi bi-clock-fill"></i><?php echo $followup['date']; ?></span>
                        <h3 class="timeline-header"><?php echo $followup['responsible_user']; ?></h3>
                        <div class="timeline-body"><?php echo $followup['comment']; ?></div>
                        <div class="timeline-footer"> <span class="btn btn-warning btn-sm"><?php echo $followup['refer_to']; ?></span> </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <div class="alert alert-dark" role="alert">هنوز اقدامی روی این درخواست انجام نشده است</div>
    <?php endif; ?>

</div>