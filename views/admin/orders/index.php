<section>
    <div class="container">
        <div class="row">
            <table class="table table-bordered">
                <tr>  
                    <th>Заказ</th>
                    <th>Имя</th>
                    <th>Телефон</th>
                    <th>Дата и время</th>
                    <th>Статус</th>
                    <th  class='text-center'>Удалить</th>
                </tr>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><a href="/adminOrders/<?= $order['id'];?>" data-id="<?= $order['id'];?>">№<?= $order['id'] ?></td>
                        <td><?= $order['user_name'] ?></td>
                        <td><?= $order['user_phone'] ?></td>
                        <td><?= $order['date'] ?></td>
                        <td>
                        <select name="status">
                            <option value="1" <?php if ($order['status'] == 1) echo ' selected="selected"'; ?>>В пути</option>
                            <option value="0" <?php if ($order['status'] == 0) echo ' selected="selected"'; ?>>Доставлен</option>
                        </select>
                        </td>
                        <td class='text-center'>
                            <a href="/adminOrders/delete/<?= $order['id'] ?>" onclick="deleteUser(this); return false;" class="icon" data-id="<?= $order['id'] ?>" >
                                <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            
        </div>
    </div>
</section>