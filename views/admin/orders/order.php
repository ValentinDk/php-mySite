<section>
    <div class="container">
        <div class="row">

            <br/>

            <h4>Заказ #<?= $order['id'] ?> <a href="/adminOrders/delete/<?= $order['id'];?>" data-id="<?= $order['id'];?>"></i>(Удалить)</a></h4>

            <br/>

             <div class="col-sm-9 padding-right">
                <div class="product-details"><!--product-details-->
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="product-information"><!--/product-information-->
                                <h2><?= $order['user_name'];?></h2>
                                <p>Телефон: <?= $order['user_phone'];?></p>
                                <p>Комментарий: <?= $order['user_comment'];?></p>
                                <p>Дата и время: <?= $order['date'];?></p>
                                <p>Статус:</p>
                                    <select name="status">
                                        <option value="1" <?php if ($order['status'] == 1) echo ' selected="selected"'; ?>>В пути</option>
                                        <option value="0" <?php if ($order['status'] == 0) echo ' selected="selected"'; ?>>Доставлен</option>
                                    </select>
                            </div><!--/product-information-->
                        </div>
                    </div>
                </div><!--/product-details-->          
            </div>
                <table class="table-bordered table-striped table">
                    <tr>
                        <th>Код товара</th>
                        <th>Название</th>
                        <th>Стомость, $</th>
                        <th>Количество, шт</th>
                    </tr>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?= $product['code'];?></td>
                            <td>
                                <a href="/product/<?= $product['id'];?>">
                                    <?= $product['name'];?>
                                </a>
                            </td>
                            <td><?= $product['price'];?></td>
                            <td><?= $userProducts[$product['id']];?></td>                    
                        </tr>
                    <?php endforeach; ?>
                        <tr>
                            <td colspan="2">Общая стоимость:</td>
                            <td><?= $totalPrice;?> $</td>
                        </tr>
                </table>        
            </div>
    </div>
</section>