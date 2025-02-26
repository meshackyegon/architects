<?php
$page        = 'book_visit';
require_once 'header.php';

$current_year   = date("Y");
$project_id=decrypt($_GET['id']);
$sql="SELECT * FROM user where user_email='$_SESSION[user_email]'";
$user=select_rows($sql)[0];
$bookvisit = get_by_id('book_visit', security('id', 'GET'));

if (!empty($bookvisit)) {
    session_assignment(array(
        'edit' => $bookvisit['prod_id']
    ), false);
    $require = false;
} else {
    $require = true;
}


$properties = get_all('property');
?>
<div class="container-fluid">
 
    <form enctype="multipart/form-data" action="<?= model_url ?>book_visit" method="POST">
        <div class="card shadow mb-4">
            <div class="card-body card-secondary">
                <br>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <p>Visits amount is Ksh. 10,000. Kindly pay for it to be done and report will be availale within 2-3 days after visit.</p>
                         <div class="col-md-12">
                                                  
                        <div class="form-group">
                                <label for="visit_date" class="form-label">Book visit's Date</label>
                            <input class="form-control" type="date" name="visit_date" required placeholder="Enter Your Date of Birth">
                        </div>
                        
                    </div>
                        <input hidden name="created_by" value="self" />
                        <input hidden name="user_id" value="<?= $_SESSION['user_id'] ?>" />
                        <input hidden name="user_email" value="<?= $user['user_email'] ?>" />
                        <input hidden name="user_phone" value="<?= $user['user_phone'] ?>" />
                        <input hidden name="project_id" value="<?= $project_id ?>" />
                        <input hidden name="payment_reason" value="Book Visit" />
                        <input hidden name="amount" value="10000" />
                    </div>
                    

                </div>
            </div>
        </div>


        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-4 text-center">
            <div class="text-center">
                <button class="btn btn-primary" type="submit" id="submit">Pay & Submit</button>
            </div>
        </div>
    </form>
</div>
<!-- End of Main Content -->


<style>
    .form-group {
        margin-top: 10px;
    }


    .HeaderTxt {
        margin: 1.2em 0em;
        font-size: 1.5em;
        font-weight: 700;
        text-align: center;
    }

    .MyDiver {
        margin-top: 50px;
        margin-bottom: 25px;
    }
</style>
<?php include_once 'footer.php'; ?>