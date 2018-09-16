<?php
    $db = mysqli_connect('localhost','root','','initfun');

    function insertToOrderDates($data, $orderId){
        foreach($data as $q){
            $getProdId = mysqli_fetch_assoc(mysqli_query($db, "SELECT id FROM product WHERE product_name = '$q['item']'");
            $query = "INSERT INTO order_dates (order_id, delivery_date, product_id, qty)
                                       VALUES ('$orderId', '$q['date']', '$getProdId', '$q['qty']')";
            mysqli_query($db, $query);
        }
    }
?>