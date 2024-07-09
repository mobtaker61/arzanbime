<div class="modal-header">
    <h5 class="modal-title">پیشنهاد قیمتی برای درخواست #<?php echo $quotation['id']; ?></h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="flex titlebox bg-zereshki p-3">
        <h2 class="text-3xl font-bold mb-2 gap-3">یکساله</h2>
    </div>
    <div class="row d-flex">
        <?php if (!empty($tariffs)) : ?>
            <table class="table table-striped hidden">
                <thead>
                    <tr>
                        <th>شرکت</th>
                        <th>طرح</th>
                        <th>تعرفه اصلی</th>
                        <th>تخفیف ویژه</th>
                        <th>پرداختی</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tariffs as $tariff) : ?>
                        <tr>
                            <td><img style="width: 48px;height: 48px;" src="<?php echo $tariff['company_icon']; ?>" alt="<?php echo $tariff['company_name']; ?>" /></td>
                            <td><?php echo $tariff['company_name'] . " - " . $tariff['package_tip']; ?></td>
                            <td><span class="numwc"><?php echo $tariff['first_year']; ?></span>&nbsp;لیر</td>
                            <td><span class="numwc"><?php echo $tariff['first_year_discount']; ?></span>&nbsp;لیر</td>
                            <td><span class="numwc"><?php echo $tariff['first_year_pay']; ?></span>&nbsp;لیر</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>هیچ تعرفه‌ای یافت نشد.</p>
        <?php endif; ?>
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>