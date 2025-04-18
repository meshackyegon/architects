<?php
$page = 'payment';
include_once 'header.php';

$property = get_by_id('property', security('id', 'GET'));

if (isset($_GET['unit'])) {
    $unit = get_by_id('property_unit', security('unit', 'GET'))['property_unit_name'];
    $amount = get_by_id('property_unit', security('unit', 'GET'))['property_unit_price'];
} else {
    $unit = "-";
    $amount = '50000';
}

?>

<head>
    <link rel="stylesheet" href="<?= admin_url ?>assets/vendor/css/pages/app-invoice.css" />
</head>

<div class="container-xxl flex-grow-1 container-p-y">

    <div class="row invoice-preview">
        <!-- Invoice -->
        <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-4">
            <div class="card invoice-preview-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column p-sm-3 p-0">
                        <div class="mb-xl-0 mb-4">
                            <div class="d-flex svg-illustration mb-3 gap-2">
                                <img src="<?= file_url . 'mpesa.png' ?>" style="width:100px;">
                            </div>
                            <p class="mb-1">PQRP+876, Westlands</p>
                            <p class="mb-1">Nairobi, Kenya</p>
                            <p class="mb-0"> 0722 000000</p>
                        </div>
                        <div>
                            <h4>Invoice #3492</h4>
                            <div class="mb-2">
                                <span class="me-1">Date Issues:</span>
                                <span class="fw-semibold">25/08/2023</span>
                            </div>
                            <div>
                                <span class="me-1">Date Due:</span>
                                <span class="fw-semibold">29/08/2023</span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <div class="row p-sm-3 p-0">
                        <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
                            <h6 class="pb-2">Invoice To:</h6>
                            <p class="mb-1"><?= $profile['user_name'] ?></p>
                            <p class="mb-1">Small Heath, B10 0HF, Nairobi</p>
                            <p class="mb-1">718-986-6062</p>
                            <p class="mb-0">peakyFBlinders@gmail.com</p>
                        </div>
                        <div class="col-xl-6 col-md-12 col-sm-7 col-12">
                            <h6 class="pb-2">Bill To:</h6>
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="pe-3">Total Due:</td>
                                        <td><?= $amount ?></td>
                                    </tr>
                                    <tr>
                                        <td class="pe-3">Bank name:</td>
                                        <td>M-Pesa</td>
                                    </tr>
                                    <tr>
                                        <td class="pe-3">Country:</td>
                                        <td>Kenya</td>
                                    </tr>
                                    <tr>
                                        <td class="pe-3">IBAN:</td>
                                        <td>ETD95476213874685</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table border-top m-0">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Phone Number</th>
                                <th>Property</th>
                                <th>Unit</th>
                                <th>Cost</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= $profile['user_name'] ?></td>
                                <td><?= $profile['user_phone'] ?></td>
                                <td class="text-nowrap"><?= $property['property_name'] ?></td>
                                <td class="text-nowrap"><?= $unit ?></td>
                                <td><?= $amount ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <!-- /Invoice -->

        <!-- Invoice Actions -->
        <div class="col-xl-3 col-md-4 col-12 invoice-actions">
            <div class="card">
                <div class="card-body">
                   
                    <button class="btn btn-label-secondary d-grid w-100 mb-3">Download</button>
                    <a class="btn btn-label-secondary d-grid w-100 mb-3" target="_blank" href="./app-invoice-print.html">
                        Print
                    </a>
                    <button class="btn btn-primary d-grid w-100" data-bs-toggle="offcanvas" data-bs-target="#addPaymentOffcanvas">
                        <span class="d-flex align-items-center justify-content-center text-nowrap"><i class="bx bx-dollar bx-xs me-1"></i>Add Payment</span>
                    </button>
                </div>
            </div>
        </div>
        <!-- /Invoice Actions -->
    </div>

    <!-- Offcanvas -->
    <!-- Send Invoice Sidebar -->
    <div class="offcanvas offcanvas-end" id="sendInvoiceOffcanvas" aria-hidden="true">
        <div class="offcanvas-header mb-3">
            <h5 class="offcanvas-title">Send Invoice</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
            <form>
                <div class="mb-3">
                    <label for="invoice-from" class="form-label">From</label>
                    <input type="text" class="form-control" id="invoice-from" value="shelbyComapny@email.com" placeholder="company@email.com" />
                </div>
                <div class="mb-3">
                    <label for="invoice-to" class="form-label">To</label>
                    <input type="text" class="form-control" id="invoice-to" value="qConsolidated@email.com" placeholder="company@email.com" />
                </div>
                <div class="mb-3">
                    <label for="invoice-subject" class="form-label">Subject</label>
                    <input type="text" class="form-control" id="invoice-subject" value="Invoice of purchased Admin Templates" placeholder="Invoice regarding goods" />
                </div>
                <div class="mb-3">
                    <label for="invoice-message" class="form-label">Message</label>
                    <textarea class="form-control" name="invoice-message" id="invoice-message" cols="3" rows="8">
Dear Queen Consolidated,
          Thank you for your business, always a pleasure to work with you!
          We have generated a new invoice in the amount of $95.59
          We would appreciate payment of this invoice by 05/11/2021</textarea>
                </div>
                <div class="mb-4">
                    <span class="badge bg-label-primary">
                        <i class="bx bx-link bx-xs"></i>
                        <span class="align-middle">Invoice Attached</span>
                    </span>
                </div>
                <div class="mb-3 d-flex flex-wrap">
                    <button type="button" class="btn btn-primary me-3" data-bs-dismiss="offcanvas">Send</button>
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <!-- /Send Invoice Sidebar -->

    <!-- Add Payment Sidebar -->
    <div class="offcanvas offcanvas-end" id="addPaymentOffcanvas" aria-hidden="true">
        <div class="offcanvas-header mb-3">
            <h5 class="offcanvas-title">Add Payment</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
            <div class="d-flex justify-content-between bg-lighter p-2 mb-3">
                <p class="mb-0">Invoice Balance:</p>
                <p class="fw-bold mb-0">$5000.00</p>
            </div>
            <form>
                <div class="mb-3">
                    <label class="form-label" for="invoiceAmount">Payment Amount</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="text" id="invoiceAmount" name="invoiceAmount" class="form-control invoice-amount" placeholder="100" />
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="payment-date">Payment Date</label>
                    <input id="payment-date" class="form-control invoice-date" type="text" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="payment-method">Payment Method</label>
                    <select class="form-select" id="payment-method">
                        <option value="" selected disabled>Select payment method</option>
                        <option value="Cash">Cash</option>
                        <option value="Bank Transfer">Bank Transfer</option>
                        <option value="Debit Card">Debit Card</option>
                        <option value="Credit Card">Credit Card</option>
                        <option value="Paypal">Paypal</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="form-label" for="payment-note">Internal Payment Note</label>
                    <textarea class="form-control" id="payment-note" rows="2"></textarea>
                </div>
                <div class="mb-3 d-flex flex-wrap">
                    <button type="button" class="btn btn-primary me-3" data-bs-dismiss="offcanvas">Send</button>
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <!-- /Add Payment Sidebar -->

    <!-- /Offcanvas -->

</div>
<!-- / Content -->


<?php
include_once 'footer.php';
?>