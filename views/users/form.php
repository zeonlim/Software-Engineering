<a href="<?= URL_BASE;?>/users">Index</a>
<form id="form" method="POST">
	<div>
		<label>Name</label>
		<input type="text" name="name" class="required name" />
		<span class="error errorName"></span>
	</div>
	<div>
		<label>Email</label>
		<input type="email" name="email" class="required email"/>
		<span class="error errorEmail"></span>
	</div>
	<div>
		<label>Password</label>
		<input type="password" name="password" class="required password"/>
		<span class="error errorPassword"></span>
	</div>
	<div>
		<label>Phone</label>
		<input type="tel" name="phone" class="required phone"/>
		<span class="error errorPhone"></span>
	</div>
	<button type="submit">Create</button>
	<span id="message"></span>
</form>
<script type="text/javascript">
	$(document).ready(function(){
		var $form = $('#form');
		var $message = $('#message');
		var testPhone = /^[\+]?[0-9]{2,4}[-]?[0-9]{7,10}$/;
		var testEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

		$('.name').on('input',function(e){
		    $('.errorName').html('');
		});

		$('.email').on('input',function(e){
		    $('.errorEmail').html('');
		});

		$('.password').on('input',function(e){
		    $('.errorPassword').html('');
		});

		$('.phone').on('input',function(e){
		    $('.errorPhone').html('');
		});


		function validate(){
			var respond = 0;
			if($('.required').val() == "")
			{
				$('.error').html('input required');
				respond = 1;
			}
			if( !testPhone.test($('.phone').val()) || $('.phone').val() == "")
			{
				$('.errorPhone').html('Phone format wrong');
				respond = 1;
			}

			if( !testEmail.test($('.email').val()) || $('.email').val() == "")
			{
				$('.errorEmail').html('Email format wrong');
				respond = 1;
			}
			return respond;
		}

		$form.on('submit', function(e) {
			var data = $(this).serializeArray();
			if(validate() == 0)
			{
				$.ajax({
					url: '<?=URL_BASE?>/users/ajax-create-user',
					method: 'POST',
					data: data,
					beforeSend: function () {
						$form.find('button').prop("disabled", true);
					},
					success: function (json) {
						if(json == 0){
							$('span.errorEmail').html('email exist');
						}else{
							$('span#message').html('insert success');
							$form.find('input').val('');
						}			
					},
					complete: function () {
						$form.find('button').prop("disabled", false);
					}
				})
			}
			return false;
		});
	});
</script>
