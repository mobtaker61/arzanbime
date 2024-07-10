<div class="col-md-8 p-2" id="pricelist" style="background-color: white;">
    <div class="btn-group mb-2" role="group" style="width: 100%;">
        <span class="btn btn-outline-primary mb-2"><strong></strong> <?php echo $quotation['name'] . ' ' . $quotation['surname']; ?></span>
        <span class="btn btn-outline-primary mb-2"><strong>تاریخ تولد: </strong> <?php echo $quotation['birth_date']; ?></span>
        <span class="btn btn-outline-primary mb-2"><strong>سن: </strong> <?php echo $quotation['age']; ?></span>
    </div>

    <?php if (!empty($tariffs)) : ?>
        <?php for ($i = 1; $i <= 2; $i++) : $color = $i == 1 ? 'primary' : 'info'; ?>
            <h2 class="alert alert-<?php echo $color?> text-center"><?php echo $i == 1 ? 'یکساله' : 'دوساله'; ?></h2>
            <div class="row d-flex">
                <?php foreach ($tariffs as &$tariff) :
                    $fyt = $i == 1 ? $tariff['first_year'] : $tariff['two_year'];
                    $fyd = $i == 1 ? $tariff['first_year_discount'] : $tariff['two_year_discount'];
                    $fyp = $i == 1 ? $tariff['first_year_pay'] : $tariff['two_year_pay'];
                ?>
                    <div class="col-md-6 col-sm-12">
                        <div class="info-box text-bg-light1 bg-gradient" style="background-color: <?php echo $tariff['company_color']; ?>33 ;">
                            <span class="info-box-icon">
                                <img style="max-width: 64px;max-height: 64px;" src="<?php echo $tariff['company_icon']; ?>" alt="<?php echo $tariff['company_name']; ?>" />
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text"><?php echo $tariff['company_name'] . " - " . $tariff['package_tip']; ?></span>
                                <div class="d-flex" style="justify-content:space-between;">
                                    <span>تعرفه: <b class="numwc"><?php echo $fyt; ?></b>&nbsp;لیر</span>
                                    <span>تخفیف: <b class="numwc"><?php echo $fyd; ?></b>&nbsp;لیر</span>
                                </div>
                                <div class="progress" role="progressbar" style="height: 16px;">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" style="width: <?php echo $tariff['discount_rate'] . '%'; ?>"><?php echo $tariff['discount_rate'] . '%'; ?></div>
                                </div> <span class="info-box-number  m-0 text-center">پرداختی: <b class="numwc t_pay"><?php echo $fyp; ?></b>&nbsp;لیر</span>
                            </div> <!-- /.info-box-content -->
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endfor; ?>
        <table class="table table-striped" id="tbtest" hidden>
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
                <?php foreach ($tariffs as &$tariff) : ?>
                    <tr>
                        <td><img style="width: 48px;height: 48px;" src="<?php echo $tariff['company_icon']; ?>" alt="<?php echo $tariff['company_name']; ?>" /></td>
                        <td><?php echo $tariff['company_name'] . " - " . $tariff['package_tip']; ?></td>
                        <td><span class="numwc"><?php echo $fyt; ?></span>&nbsp;لیر</td>
                        <td><span class="badge text-bg-danger"><?php echo $tariff['discount_rate'] . '%'; ?></span><span class="numwc"><?php echo $fyd; ?></span>&nbsp;لیر</td>
                        <td><span class="numwc"><?php echo $fyp; ?></span>&nbsp;لیر</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>هیچ تعرفه‌ای یافت نشد.</p>
    <?php endif; ?>

</div>
<div class="col-md-4">
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