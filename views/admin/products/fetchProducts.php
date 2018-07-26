<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Товары</h2>
    <?php foreach ($products as $product): ?>
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <div class="product-img"
                            style="background-image: url('<?= models\Product::getImage($product['id']) ?>'); height: 250px;">
                        </div>
                        <h2><?= $product['price'];?>$</h2>
                        <p>
                            <a href="/product/<?= $product['id'];?>">
                                <?= $product['name'];?>
                            </a>
                        </p> 
                        <a href="/adminProducts/edit/<?= $product['id'];?>" class="btn btn-default " data-id="<?= $product['id'];?>"></i>Изменить</a>
                    </div>
                    <?php if ($product['is_new']): ?>
                    <img src="/template/images/home/new.png" class="new" alt="" />
                <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?> 
</div><!--features_items-->
<i><p align="center"><a href="/adminProducts/create" >Добавить товар</a></p></i>