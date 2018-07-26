<section>
    <div class="container">
        <div class="row">
             <div class="col-sm-9 padding-right">
                <div class="product-details"><!--product-details-->
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="product-information"><!--/product-information-->
                                <h2><?= $user['name'];?></h2>
                                <p>Эл. адрес: <?= $user['email'];?></p>
                            </div><!--/product-information-->
                        </div>
                    </div>
                </div><!--/product-details-->          
            </div>
                <table class="table-bordered table-striped table">
                    <tr>
                        <th>Заказ</th>
                        <th>Телефон</th>
                        <th>Комментарий</th>
                        <th>Дата</th>
                        <th>Стоимость</th>
                        <th>Статус</th>
                    </tr>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td>№<?= $order['id'];?></td>
                            <td><?= $order['user_phone'];?></td>
                            <td><?= $order['user_comment'];?></td>
                            <td><?= $order['date'];?></td>
                            <td><?= $order['price'];?>$</td>
                            <td><?php if ($order['status'] == 1) echo "В пути"; ?>
                            	<?php if ($order['status'] == 0) echo "Доставлен"; ?>
                                
                            </td>                     
                        </tr>
                    <?php endforeach; ?>
                </table>        
            </div>
    </div>
</section>