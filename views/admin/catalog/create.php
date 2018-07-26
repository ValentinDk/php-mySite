<section>
    <div class="container">
        <div class="row">

        	<?php if ($result): ?>
					<h3>Категория успешно добавлена!</h3>
			<?php else: ?>
			
            <br/>

            <h4>Добавить категорию</h4>

            <br/>

            <div class="col-lg-4">

                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <p>Название категории</p>
                        <input type="text" name="name" placeholder="" value="">

                        <p>Позиция в списке</p>
                        <input type="text" name="sort_order" placeholder="" value="">

                        <p>Статус</p>
                        <select name="status">
                            <option value="1" <?= ' selected="selected"'; ?>>Отображается</option>
                            <option value="0" <?= ' selected="selected"'; ?>>Скрыт</option>
                        </select>
                        
                        <br/><br/>
                        
                        <input type="submit" name="submit" class="btn btn-default" value="Добавить">
         
                        <br/><br/>
                        
                    </form>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>