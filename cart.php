<?php include('header.php') ?>
<?php require 'config/config.php';  ?>


<section class="banner-area organic-breadcrumb">
<div class="container">
<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
<div class="col-first">
<h1>Shopping Cart</h1>
<nav class="d-flex align-items-center">
<a href="index.php">Home<span class="lnr lnr-arrow-right"></span></a>
<a href="cart.php">Cart</a>
</nav>
</div>
</div>
</div>
</section>


<section class="cart_area">
<div class="container">
<div class="col-lg-10 cart_inner">
<div class="table-responsive">
<?php if(!empty($_SESSION['cart'])) : ?>
    <table class="table">
<thead>
<tr>
<th scope="col">Product</th>
<th scope="col"></th>
<th scope="col">Price</th>
<th scope="col"></th>
<th scope="col">Quantity</th>

<th scope="col">Total</th>
<th scope="col">Action</th>
</tr>
</thead>
<tbody>
 
     




<?php
    
    $total = 0;
    foreach ($_SESSION['cart'] as $key => $qty) : 
    $id =str_replace('id','',$key);


    $stmt = $pdo->prepare("SELECT * FROM products WHERE id =".$id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $total += $result['price'] * $qty;
    ?> 
    <tr>

    <td>
    <div class="media">
    <div class="d-flex">
    <img src="./admin/images/<?= $result['image'] ?>" alt width="60px" height="65px">
    </div>
    
    <div class="media-body">
    <p style="color:black" class="text-uppercase"><?= $result['name'] ?></p>
    </div>
    </div>
    </td>
    <td></td>
    <td>
    <h5 title="Price" style="cursor:pointer">$<?= $result['price'] ?></h5>
    </td>
    <td></td>
    <td>
    <div class="product_count">
    <input type="text" name="qty" style="border:0px; font-size:medium; font-weight:500; cursor:pointer" id="sst" maxlength="12" value="<?= $qty ?>" title="Quantity" class="input-text qty">
    </div>
    </td>
    
    <td>
    <h5 title="Total" style="cursor:pointer">$<?= $result['price'] * $qty ?></h5>
    </td>
    
    <td>
        <a href="cart_item_clear.php?pid=<?= $result['id'] ?>"  class="primary-btn " style="line-height:31px; padding-left:10px; padding-right:10px;  border-radius:4px; ">Clear</a>
    </td>
    
</tr>
<?php endforeach ?>
    <tr>
    <td>
    </td>
    <td>
    </td>
    <td>
    </td>
    <td>
    </td>
    
    <td>
    </td>
    <td>
    <h3 style="color:black">SUBTOTAL -</h3>
    </td>
    <td>
    <h3 title="Total Price" style="cursor:pointer;color:red">$<?= $total ?></h3>
    </td>
</tr>


  
    

<tr class="out_button_area">
<td>
</td>
<td>
</td>
<td>
</td>
<td>
</td>
<td>
</td>
<td>
</td>
<td>
<div class="checkout_btn_inner d-flex align-items-center">
<a class="gray_btn" href="clearAll.php">Clear All</a>
<a class="primary-btn" href="index.php">Continue Shopping</a>
<a class="gray_btn" href="sale_order.php">Order Submit</a>
</div>
</td>
</tr>
</tbody>
</table>
<?php else :?>
    <h2 style="text-align: center; color:blue">No Order Yet!!</h2><a href="index.php">Continue Shopping >></a>
    
<?php endif ?>

</div>
</div>
</div>
</section>


<?php include('footer.php') ?>