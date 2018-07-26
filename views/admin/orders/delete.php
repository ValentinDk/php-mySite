<section>
    <div class="container">
        <div class="row">

            <?php if ($result): ?>
                    <h3>Заказ удалён!</h3>
            <?php else: ?>
            

            <br/>

            <h4>Вы уверены, что хотите удалить заказ?</h4>

            <br/>

             <table class="table table-bordered">
                <tr>  
                    <th>Заказ</th>
                    <th>Имя</th>
                    <th>Телефон</th>
                    <th>Дата и время</th>
                    <th>Статус</th>
                </tr>
                        <td><a href="/adminOrders/<?= $order['id'];?>" data-id="<?= $order['id'];?>">№<?= $order['id'] ?></td>
                        <td><?= $order['user_name'] ?></td>
                        <td><?= $order['user_phone'] ?></td>
                        <td><?= $order['date'] ?></td>
                        <td><?php if ($order['status'] == 1) echo "В пути"; ?>
                            <?php if ($order['status'] == 0) echo "Доставлен"; ?>
                                
                            </td>
            </table>
                
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