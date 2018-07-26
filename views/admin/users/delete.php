<section>
    <div class="container">
        <div class="row">

            <?php if ($result): ?>
                    <h3>Пользователь удалён!</h3>
            <?php else: ?>
            

            <br/>

            <h4>Вы уверены, что хотите удалить пользователя?</h4>

            <br/>

             <div class="col-sm-9 padding-right">
                        <div class="product-details"><!--product-details-->
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="view-product">
                                        <img src="/template/images/product-details/1.jpg" alt="" />
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="product-information"><!--/product-information-->
                                        <h2><?= $user['name'];?></h2>
                                        <p>Электронная почта: <?= $user['email'];?></p>
                                        <p>Пароль: <?= $user['password'];?></p>
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