<section>
    <div class="container">
        <div class="row">
            
            <?= $categoriesView;?>

            <div class="col-sm-9 padding-right">
                <div class="features_items">
                    <h2 class="title text-center">Корзина</h2>
                        <p>Вы выбрали такие товары:</p>
                            <div id="table-cart"><?= $tableInCart; ?></div>
                        <a href="/cart/checkout" class="btn btn-default checkout"><i class="fa fa-shopping-cart"></i> Оформить заказ</a>
                </div>
            </div>
        </div>
    </div>
</section>
