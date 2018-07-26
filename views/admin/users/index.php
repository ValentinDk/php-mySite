<section>
    <div class="container">
        <div class="row">
            <table class="table table-bordered">
                <tr>  
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Роль</th>
                    <th  class='text-center'>Удалить</th>
                </tr>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user['name'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['role'] ?></td>
                        <td class='text-center'>
                            <a href="/adminUsers/delete/<?= $user['id'] ?>" onclick="deleteUser(this); return false;" class="icon" data-id="<?= $user['id'] ?>" >
                                <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            
        </div>
    </div>
</section>