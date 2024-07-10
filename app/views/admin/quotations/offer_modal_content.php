<div class="row d-flex p-3">
    <div class="btn-group mb-2" role="group" style="width: 100%;">
        <span class="btn btn-outline-primary mb-2"><strong></strong> <?php echo $quotation['name'] . ' ' . $quotation['surname']; ?></span>
        <span class="btn btn-outline-primary mb-2"><strong>تاریخ تولد: </strong> <?php echo $quotation['birth_date']; ?></span>
        <span class="btn btn-outline-primary mb-2"><strong>سن: </strong> <?php echo $quotation['age']; ?></span>
        <span class="btn btn-outline-primary mb-2"><strong>تاریخ استعلام: </strong> <?php echo '1'; ?></span>
    </div>

    <?php if (!empty($tariffs)) : ?>
        <table class="table table-striped hidden" id="offers_result">
            <thead>
                <tr class="text-center">
                    <th>شرکت</th>
                    <th>طرح</th>
                    <th>تعرفه اصلی</th>
                    <th>تخفیف ویژه</th>
                    <th>پرداختی</th>
                    <th>سود</th>
                    <th>بروکر</th>
                </tr>
            </thead>
            <tbody style="vertical-align: baseline;">
                <?php for ($i = 1; $i <= 2; $i++) :  ?>
                    <tr>
                        <td colspan=5 style="background-color: darkred;color: white;">
                            <h2 class="text-center"><?php echo $i == 1 ? 'یکساله' : 'دوساله'; ?></h2>
                        </td>
                        <td colspan=2 style="background-color: darkblue;color: white;">
                            <h2 class="text-center">سود</h2>
                        </td>
                    </tr>
                    <?php foreach ($tariffs as &$tariff) :
                        $fyt = $i == 1 ? $tariff['first_year'] : $tariff['two_year'];
                        $fyd = $i == 1 ? $tariff['first_year_discount'] : $tariff['two_year_discount'];
                        $fyp = $i == 1 ? $tariff['first_year_pay'] : $tariff['two_year_pay'];
                        $profit = $i == 1 ? $tariff['first_year_profit'] : $tariff['two_year_profit'];
                        $highestCommission = isset($tariff['highest_commission']) ? $tariff['highest_commission'] : 'N/A';
                        $brokerName = isset($tariff['broker_name']) ? $tariff['broker_name'] : 'N/A';
                    ?>
                        <tr>
                            <td><img style="width: 48px;height: 48px;" src="<?php echo $tariff['company_icon']; ?>" alt="<?php echo $tariff['company_name']; ?>" /></td>
                            <td><?php echo $tariff['company_name'] . " - " . $tariff['package_tip']; ?></td>
                            <td><span class="numwc"><?php echo intval($fyt) ?></span>&nbsp;لیر</td>
                            <td><span class="badge text-bg-danger"><?php echo $tariff['discount_rate'] . '%'; ?></span> <span class="numwc"><?php echo $fyd ?></span>&nbsp;لیر</td>
                            <td><span class="numwc"><?php echo $fyp ?></span>&nbsp;لیر</td>
                            <td><span class="badge text-bg-success"><?php echo $highestCommission . '%'; ?></span> <span class="numwc"><?php echo $profit; ?></span>&nbsp;لیر</td>
                            <td><?php echo $brokerName; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endfor; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>هیچ تعرفه‌ای یافت نشد.</p>
    <?php endif; ?>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        // Capture pricelist div as image using html-to-image.js
        document.getElementById('capture-price_table').addEventListener('click', function() {
            htmlToImage.toJpeg(document.getElementById('offers-modal-content'), {
                    quality: 0.95
                })
                .then(function(dataUrl) {
                    const link = document.createElement('a');
                    link.href = dataUrl;
                    link.download = 'pricelist.png';
                    link.click();
                })
                .catch(function(error) {
                    console.error('oops, something went wrong!', error);
                });
        });
    });
</script>