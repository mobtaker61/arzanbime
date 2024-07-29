<div class="modal fade" id="transactionsModal" tabindex="-1" aria-labelledby="transactionsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="transactionsModalLabel">لیست تراکنش‌ها</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>تاریخ</th>
                            <th>نوع تراکنش</th>
                            <th>شرح</th>
                            <th>بدهکار</th>
                            <th>بستانکار</th>
                        </tr>
                    </thead>
                    <tbody id="transactionsListBody">
                        <!-- لیست تراکنش‌ها در اینجا قرار می‌گیرد -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer card-success" style="flex-wrap: nowrap;justify-content: space-evenly;">
                <div class="col-3 text-center alert alert-primary"><span>جمع کل بدهکار: <span id="totalDebit" class="numwc"></span></span></div>
                <div class="col-3 text-center alert alert-warning"><span>جمع کل بستانکار: <span id="totalCredit" class="numwc"></span></span></div>
                <div class="col-3 text-center alert"><span>مانده: <span id="balance" class="numwc"></span></span></div>
                <div class="col-3 text-center">
                    <button id="filter-btn" type="button" class="btn btn-secondary d-none">تسویه نشده‌ها</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Open transactions modal
        document.querySelectorAll(".transactions-btn").forEach(button => {
            button.addEventListener("click", function() {
                const userId = this.getAttribute("data-id");
                fetch(`/admin/users/getUserTransactions/${userId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const transactionsList = data.transactions;
                            let transactionsHtml = '';
                            transactionsList.forEach(transaction => {
                                transactionsHtml += `
                                    <tr>
                                        <td>${transaction.transaction_date}</td>
                                        <td>${transaction.type_name}</td>
                                        <td>${transaction.description}</td>
                                        <td><span class="numwc">${transaction.debit}</span></td>
                                        <td><span class="numwc">${transaction.credit}</span></td>
                                    </tr>
                                `;
                            });
                            document.getElementById('transactionsListBody').innerHTML = transactionsHtml;
                            document.getElementById('totalDebit').innerText = data.sumDebitCredit.total_debit;
                            document.getElementById('totalCredit').innerText = data.sumDebitCredit.total_credit;
                            document.getElementById('balance').innerText = data.balance;
                            let cls = "alert-success";
                            if (data.balance < 0) {
                                cls = "alert-danger";
                            }
                            document.getElementById('balance').parentElement.parentElement.classList.add(cls);
                            applyNumberFormatting();
                            if (parseFloat(document.getElementById('balance').innerText) < 0) {
                                document.getElementById('filter-btn').classList.remove('d-none');
                                document.getElementById('filter-btn').setAttribute('data-id', userId);
                            }
                            new bootstrap.Modal(document.getElementById('transactionsModal')).show();
                        } else {
                            alert('خطا در بارگیری تراکنش‌ها');
                        }
                    }).catch(error => console.error('Error:', error));
            });
        });

        // Filter unpaid transactions
        document.getElementById('filter-btn').addEventListener('click', function() {
            const userId = this.getAttribute("data-id");
            fetch(`/admin/users/getFilteredTransactions/${userId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const transactionsList = data.transactions;
                        let transactionsHtml = '';
                        transactionsList.forEach(transaction => {
                            transactionsHtml += `
                                <tr>
                                    <td>${transaction.transaction_date}</td>
                                    <td>${transaction.type_name}</td>
                                    <td>${transaction.description}</td>
                                    <td><span class="numwc">${transaction.debit}</span></td>
                                    <td><span class="numwc">${transaction.credit}</span></td>
                                </tr>
                            `;
                        });
                        document.getElementById('transactionsListBody').innerHTML = transactionsHtml;
                        applyNumberFormatting();
                    } else {
                        alert('خطا در فیلتر تراکنش‌ها');
                    }
                }).catch(error => console.error('Error:', error));
        });
    });
</script>