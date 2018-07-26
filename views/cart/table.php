<table class="table-bordered table-striped table">
    <tr>
        <th>Код товара</th>
        <th>Название</th>
        <th>Стомость, $</th>
        <th>Количество, шт</th>
        <th>Удалить</th>
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
            <td><?= $productsInCart[$product['id']];?></td>
             <td>
                <a href="#" class="btn btn-default deleteItems" data-id="<?= $product['id']; ?>"onclick="deleteCartProduct(this); return false;">
                    <i class="fa fa-times"></i>
                </a>
            </td>                     
        </tr>
    <?php endforeach; ?>
        <tr>
            <td colspan="3">Общая стоимость:</td>
            <td><?= $totalPrice;?> $</td>
        </tr>
</table>