<section>
    <div class="container">
        <div class="row">

        	<?php if ($result): ?>
					<h3>Товар удалён!</h3>
			<?php else: ?>
			

            <br/>

            <h4>Вы уверены, что хотите удалить товар?</h4>

            <br/>

             <div class="col-sm-9 padding-right">
                        <div class="product-details"><!--product-details-->
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="view-product">
                                        <div class="product-img"
                                            style="background-image: url('<?= models\Product::getImage($product['id']) ?>'); height: 350px;">
                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="product-information"><!--/product-information-->
                                        <img src="/template/images/product-details/new.jpg" class="newarrival" alt="" />
                                        <h2><?= $product['name'];?></h2>
                                        <p>Код товара: <?= $product['code'];?></p>
                                        <span>
                                            <span>US $<?= $product['price'];?></span>
                                        </span>
                                        <p><b>Наличие:</b>
                                            <?php if ($product['availability'] == 1): ?>
                                                 <?= "Да"; ?>
                                            <?php else: ?>
                                                <?= "Нет"; ?>
                                            <?php endif; ?>
                                        </p>
                                        <p><b>Производитель:</b><?= $product['brand'];?></p>
                                        <br>
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

            <div class="col-lg-4">

                <div class="login-form">
                
                    <form action="#" method="post" enctype="multipart/form-data">

                        <input type="submit" name="delete" class="btn btn-default" value="Да">
                        <input type="submit" name="undelete" class="btn btn-default" value="Нет">

                    </form>
                </div>
                
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>