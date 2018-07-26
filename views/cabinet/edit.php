<section>
	<div class="container">
		<div class="row">
			
			<div class="col-sm-4 col-sm-offset-4 padding-right">

				<?php if ($result): ?>
					<h3>Данные изменены!</h3>
				<?php else: ?>
					<?php if (isset($errors) && is_array($errors)): ?>
						<ul>
							<?php foreach ($errors as $error): ?>
								<li> - <?= $error; ?></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>

					<div class="signup-form">
						<h2>Редактирование данных</h2>
						<form action="#" method="post">
							<input type="text" name="name" placeholder="Имя" value="<?= $name; ?>" />
							<input type="password" name="password" placeholder="Пароль" value="<?= $password; ?>"/>
							<input type="submit" name="submit" class="btn btn-default" value ="Изменить"/>
						</form>
					</div>
					
				<?php endif; ?>
				<br/>
				<br/>
			</div>
		</div>
	</div>
</section>