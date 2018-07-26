<section>
    <div class="container">
        <div class="row">

            <?php if ($result): ?>
                    <h3>Категория удалена!</h3>
            <?php else: ?>
            

            <br/>

            <h4>Вы уверены, что хотите удалить категорию?</h4>

            <br/>

             <div class="col-sm-9 padding-right">
                        <div class="product-details"><!--product-details-->
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="view-product">
                                        <img src="/template/images/product-details/2.jpg" alt="" />
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="product-information"><!--/product-information-->
                                        <h2><?= $categories['name'];?></h2>
                                        <p>Позиция в списке: <?= $categories['sort_order'];?></p>
                                        <p><b>Статус:</b>
                                            <?php if ($categories['status'] == 1): ?>
                                                 <?= "Отображается"; ?>
                                            <?php else: ?>
                                                <?= "Скрыт"; ?>
                                            <?php endif; ?>
                                    </div><!--/product-information-->
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