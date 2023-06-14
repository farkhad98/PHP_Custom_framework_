<div class="">

	<div class="col-md-6 my-3 mx-auto">
		<h2 class="text-center">посты</h2>
	</div>

	<div>

	<?php foreach($posts as $post){ ?>
		<div>
			<p class="idXuy">id:<?php echo $post['id'] ?></p>
			<p class="titleXuy">title: <?php echo htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8'); ?></p>
			<p class="textXuy">text: <?php echo htmlspecialchars($post['body'], ENT_QUOTES, 'UTF-8'); ?></p>
			<button type="button" class="btn btn-warning">Изменить</button>
			<button type="button" class="btn btn-danger delete">Удалить</button>
		</div>
	<?php } ?>
	</div>

	<div class="col-md-6 my-3 mx-auto">
		<button type="button" class="btn btn-success send">
		  Добавить
		</button>
	</div>
</div>

<!-- Store modal -->
<!-- Modal -->
<div class="modal fade" id="storeModal" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Создать Пост</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="form" action="" method="POST">
		<input type="hidden" name="id" id="id">
      	  <div class="modal-body">
      	  	<div class="form-group">
      	  		<label>Имя</label>
      	  		<input class="form-control title" type="text" name="title" required>
      	  	</div>
  	  		<div class="form-group">
      	  		<label>Текст</label>
      	  		<textarea class="form-control body" name="body"></textarea>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
	        <button class="btn btn-success submit">Сохранить</button>
	      </div>
      </form>
    </div>
  </div>
</div>

<!-- delete form -->
<form id="delete-form" action="/posts/destroy" method="POST">
	<input type="hidden" name="id" id="postId">
</form>

<script type="text/javascript">
	$('.btn-warning').on('click', function(){
		$('#form').attr('action','/posts/patch')
		var parent = $(this).parent('div')
		$('.title').attr('value',parent.children('.titleXuy').text().split('title:').slice(1))
		$('.body').html(parent.children('.textXuy').text().split('text:'))
		$('#id').val(parent.children('.idXuy').text().split('id:').slice(1))

		$('#storeModal').modal('show')
	})

	$('.send').on('click', function(){
		$('#form').attr('action','/posts/store')
		$('.title').attr('value','')
		$('.body').html('')
		$('#storeModal').modal('show')
	})

	$('.delete').on('click',function(){
		var parent = $(this).parent('div')
		$('#postId').val(Number((parent.children('.idXuy').text().split('id:').slice(1))))
		console.log($('#postId').val())
		$('#delete-form').submit()
	})

	// $('.submit').on('click',function(e){
	// 	e.preventDefault();
	// 	$('#form').submit().then(setHeader())
	// })

	// function setHeader(){window.location.href ="http://127.0.0.1:8080/posts"}
</script>
