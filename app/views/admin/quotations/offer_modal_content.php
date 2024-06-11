<div class="modal-header">
    <h5 class="modal-title">Offers for Quotation #<?php echo $quotation['id']; ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
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
            <?php foreach ($tariffs as $tariff): ?>
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
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
