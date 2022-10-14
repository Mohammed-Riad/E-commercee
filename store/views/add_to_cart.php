
<?php
require_once 'connection.php';

$prodId = $_GET['ad'];

if (isset($_GET['q'])) {
    $qunatity = $_GET['q'];
} else {
    $qunatity = 1;
}

if (!isset($_SESSION['userid']) && !isset($_GET['newQ'])) {
    if (isset($_SESSION['cartVisitor'])) {
        $inCart = 0;
        for ($i = 0; $i < count($_SESSION['cartVisitor']); $i++) {
            if ($_SESSION['cartVisitor'][$i][0] == $prodId) {
                $_SESSION['cartVisitor'][$i][1] += $qunatity;
                $inCart = 1;
            }
        }
        if (!$inCart) {
            array_push($_SESSION['cartVisitor'], [$prodId, $qunatity]);
        }
    } else {
        $_SESSION['cartVisitor'] = [[$prodId, $qunatity]];
    }
} elseif (isset($_SESSION['userid'])) {
    $curId = $_SESSION['userid'];
    $cart = $connect->query("SELECT * FROM cart WHERE user_id='$curId'");
    $cart = $cart->fetchAll();
    if ($cart) {
        $inCart = 0;
        foreach ($cart as $c) {
            if ($c['product_id'] == $prodId) {
                $newQuantity = $c['quantity'] + $qunatity;
                $increaseQuantity = $connect->query("UPDATE cart SET quantity='$newQuantity'
                WHERE user_id='$curId' AND product_id='$prodId'");
                $inCart = 1;
            }
        }
        if (!$inCart) {
            $addToCart = $connect->query("INSERT INTO cart (product_id,user_id,quantity)
             VALUES ('$prodId','$curId','$qunatity')");
        }
    } else {
        $addToCart = $connect->query("INSERT INTO cart (product_id,user_id,quantity)
        VALUES ('$prodId','$curId','$qunatity')");
    }
}

if (isset($_GET['from'])) {
    if ($_GET['from'] == 'index') {
        header('location: ./index.php');
    }
    if ($_GET['from'] == 'shop') {
        header('location: ./shop.php');
    }
    if ($_GET['from'] == 'product') {
        header("location: ./product_page.php?prod_id=$prodId");
    }
    if ($_GET['from'] == 'cart') {
        header('location: ./cart.php');
    }
}

if (isset($_GET['newQ'])) {
    $inCart = 0;
    for ($i = 0; $i < count($_SESSION['cartVisitor']); $i++) {
        if ($_SESSION['cartVisitor'][$i][0] == $prodId) {
            $_SESSION['cartVisitor'][$i][1] = $_GET['newQ'];
            $inCart = 1;
        }
    }
    if (!$inCart) {
        array_push($_SESSION['cartVisitor'], [$prodId, $qunatity]);
    }
    // print_r($_SESSION);
}

// print_r($_SESSION);

// $_SESSION['cartVisitor'] = [[4, 1]];
// print_r($_SESSION['cartVisitor'][0][0]);
// print_r($_SESSION);

// if (isset($_GET['ad'])) {
//     $curId = $_SESSION['userid'];
//     $qunatity = 1;
//     $insert = $connect->prepare(
//         'INSERT INTO cart (quantity,product_id,user_id) VALUES (?,?,?)'
//     );
//     $insert->execute([$qunatity, $_GET['ad'], $_SESSION['userid']]);
//     if ($_GET['from'] == 'shop') {
//         // header('location: ./shop.php');
//     } else {
//         // header('location: ./index.php');
//     }
// }
?>

<?php
// if (isset($_GET['ad']) && isset($_GET['q'])) {
//     $qunatity = $_GET['q'];
//     $insert = $connect->prepare(
//         'INSERT INTO cart (quantity,product_id,user_id) VALUES (?,?,?)'
//     );
//     $insert->execute([$qunatity, $_GET['ad'], $_SESSION['userid']]);
// }
?>