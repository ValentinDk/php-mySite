<section>
    <div class="container">
        <div class="row">

            <?= $categoriesView;?>

            <div class="col-sm-9 padding-right">
                <div class="product-details"><!--product-details-->
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="view-product">
                                <div class="product-img"
                                    style="background-image: url('<?= models\Product::getImage($product['id']) ?>'); height: 500px;">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="product-information"><!--/product-information-->
                                <img src="/template/images/product-details/new.jpg" class="newarrival" alt="" />
                                <h2><?= $product['name'];?></h2>
                                <p>Код товара: <?= $product['code'];?></p>
                                <p><b>Наличие:</b>
                                    <?php if ($product['availability'] == 1): ?>
                                         <?= "Да"; ?>
                                    <?php else: ?>
                                        <?= "Нет"; ?>
                                    <?php endif; ?>
                                </p>
                                <p><b>Производитель: </b><?= $product['brand'];?></p>
                                <br>
                                <a href="#" class="btn btn-default add-to-cart" data-id="<?= $product['id'];?>"><i class="fa fa-shopping-cart"></i>В корзину</a>
                            </div><!--/product-information-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <h5>Описание товара</h5>
                            <?= $product['description'];?>
                        </div>
                    </div>
                </div><!--/product-details-->

            </div>
        </div>
    </div>
</section>
<br/>
<br/>
