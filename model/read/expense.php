<?php
function get_expense_by_type($type)
{

    //get current timedate
    $current_time = date("h:i A");

    //get current date
    $current_date = date("Y-m-d");


    global $con;
    if ($type == 'daily') {
        $sql    = "SELECT SUM(expense_amount) AS total FROM expense WHERE expense_date='$current_date'";
        $result = select_rows($sql);
    } else if ($type == 'weekly') {


        //Minus 7 days from current date
        $from_date  = date("Y-m-d", strtotime("-7 days"));
        $sql        = "SELECT SUM(expense_amount) AS total FROM expense WHERE  expense_date>='$from_date' AND NOW() ";
        $result     = select_rows($sql);
    } else if ($type == 'all') {
        $sql        = "SELECT SUM(expense_amount) as total FROM expense";
        $result     = select_rows($sql);
    } else if ($type == 'monthly') {
        $sql        = "SELECT SUM(expense_amount) AS total FROM expense WHERE  MONTH(STR_TO_DATE(expense_date, '%Y-%m-%d')) = MONTH(NOW())";
        $result     = select_rows($sql);
    } else if ($type == 'yearly') {
        $sql        = "SELECT SUM(expense_amount) AS total FROM expense WHERE   YEAR(STR_TO_DATE(expense_date, '%Y-%m-%d')) = YEAR(NOW()) ";
        $result     = select_rows($sql);
    }



    $sum = $result['total'];

    return $sum;
}


function get_monthly_expense($month, $year)
{
    $total_expense = 0;
    $sql = "SELECT * FROM expense WHERE  MONTH(STR_TO_DATE(expense_date,'%Y-%m-%d')) = '$month' AND YEAR(STR_TO_DATE(expense_date,'%Y-%m-%d')) = '$year'";
    $rows = select_rows($sql);
    // echo $sql;

    foreach ($rows as $row) {
        $cost           = floatval($row['expense_amount']);
        $total_expense  += $cost;
    }

    return $total_expense;
}


function get_current_year_expense($year)
{
    $sql = "SELECT SUM(expense_amount) as total FROM expense WHERE YEAR(STR_TO_DATE(expense_date,'%Y-%m-%d')) = '$year'";
    $row = select_rows($sql);
    $sum = $row[0];
    $sum = $sum['total'];
    if (empty($sum)){
        return 0;
    }else{
        return $sum;
    }
}

function get_total_expense_by_date_range($from_date,$to_date,$category_id)
{
    $sql = "SELECT SUM(expense_amount) as total FROM expense WHERE expense_date>='$from_date' AND expense_date<='$to_date' AND category_id='$category_id'";
    $row = select_rows($sql)[0];
    $sum = $row['total'];
    return $sum;
}

function get_all_expenses_by_date_range($from_date,$to_date)
{
    $sql = "SELECT SUM(expense_amount) as total FROM expense WHERE  expense_date>='$from_date' AND expense_date<='$to_date'";
    $row = select_rows($sql)[0];
    $sum = $row['total'];
    return $sum;
}

function get_total_expense()
{
    $sql = "SELECT SUM(expense_amount) as total FROM expense";
    $row =  select_rows($sql)[0];
    $sum = $row['total'];
    return $sum;
}