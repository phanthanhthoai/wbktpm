<?php
	$title = 'Thêm/Sửa Tài Khoản Người Dùng';
	$baseUrl = '../';
	require_once('../layouts/header.php');

	$id = $msg = $name = $email = $mobile = $address = $role_id = '';
	require_once('form_save.php');

	$id = getGet('id');
	if($id != '' && $id > 0) {
		$sql = "select * from User where id = '$id'";
		$userItem = executeResult($sql, true);
		if($userItem != null) {
			$name = $userItem[0]['name'];
			$email = $userItem[0]['email'];
			$mobile = $userItem[0]['mobile'];
			$address = $userItem[0]['address'];
			$role_id = $userItem[0]['role_id'];
		} else {
			$id = 0;
		}
	} else {
		$id = 0;
	}

	$sql = "select * from Role";
	$roleItems = executeResult($sql);
?>

<div class="row" style="margin-top: 20px;">
	<div class="col-md-12 table-responsive">
		<h3>Thêm/Sửa Tài Khoản Người Dùng</h3>
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h5 style="color: red;"><?=$msg?></h5>
			</div>
			<div class="panel-body">
				<form method="post" onsubmit="return validateForm();">
					<div class="form-group">
					  <label for="usr">Họ & Tên:</label>
					  <input required="true" type="text" class="form-control" id="usr" name="name" value="<?=$name?>">
					  <input type="text" name="id" value="<?=$id?>" hidden="true">
					</div>
					<div class="form-group">
					  <label for="usr">Role:</label>
					  <select class="form-control" name="role_id" id="role_id" required="true">
					  	<option value="">-- Chọn --</option>
					  	<?php
					  		foreach($roleItems as $role) {
								if($_SESSION['current_user']['role_id']==1)
                    			{
									if($role['id'] == $role_id) {
										echo '<option selected value="'.$role['id'].'">'.$role['name'].'</option>';
									} else {
										echo '<option value="'.$role['id'].'">'.$role['name'].'</option>';
									}
									
								} 
								else if($_SESSION['current_user']['role_id']==2)
                    			{ 	if($role['id']!=2 && $role['id']!=1)
									{
										if($role['id'] == $role_id) {
											echo '<option selected value="'.$role['id'].'">'.$role['name'].'</option>';
										} else {
											echo '<option value="'.$role['id'].'">'.$role['name'].'</option>';
										}
									}	
								} else {
									if($role['id']==5)
									{
										if($role['id'] == $role_id) {
											echo '<option selected value="'.$role['id'].'">'.$role['name'].'</option>';
										} else {
											echo '<option value="'.$role['id'].'">'.$role['name'].'</option>';
										}
									}	
								}
					  		}
					  	?>
					  </select>
					</div>
					<div class="form-group">
					  <label for="email">Email:</label>
					  <input required="true" type="email" class="form-control" id="email" name="email" value="<?=$email?>">
					</div>
					<div class="form-group">
					  <label for="mobile">SĐT:</label>
					  <input required="true" type="tel" class="form-control" id="mobile" name="mobile" value="<?=$mobile?>">
					</div>
					<div class="form-group">
					  <label for="address">Địa Chỉ:</label>
					  <input required="true" type="text" class="form-control" id="address" name="address" value="<?=$address?>">
					</div>
					<div class="form-group">
					  <label for="pwd">Mật Khẩu:</label>
					  <input <?=($id > 0?'':'required="true"')?> type="password" class="form-control" id="pwd" name="password" minlength="7">
					</div>
					<div class="form-group">
					  <label for="confirmation_pwd">Xác Minh Mật Khẩu:</label>
					  <input <?=($id > 0?'':'required="true"')?> type="password" class="form-control" id="confirmation_pwd" minlength="7">
					</div>
					<button class="btn btn-success">Đăng Ký</button>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function validateForm() {
		$pwd = $('#pwd').val();
		$confirmPwd = $('#confirmation_pwd').val();
		if($pwd != $confirmPwd) {
			alert("Mật khẩu không khớp, vui lòng kiểm tra lại")
			return false
		}
		return true
	}
</script>

<?php
	require_once('../layouts/footer.php');
?>