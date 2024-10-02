<?php
if(!empty($_POST)) {
	$id = getPost('id');
	$name = getPost('name');
	$brand_id=getPOST('brand_id');
	$featured_image = moveFile('featured_image');
	$description = getPost('description');
	$category_id = getPost('category_id');
	$discount_id = getPost('discount_id');
	$created_date = $updated_at = date("Y-m-d H:i:s");
	if($id > 0) {
		//update
		if($featured_image != '') {
			$sql = "update Product set discount_id='$discount_id', brand_id='$brand_id',  featured_image = '$featured_image', name = '$name', description = '$description', updated_at = '$updated_at', category_id = '$category_id' where id = $id";
		} else {
			$sql = "update Product set discount_id='$discount_id', brand_id='$brand_id', name = '$name', description = '$description', updated_at = '$updated_at', category_id = '$category_id' where id = $id";
		}
		execute($sql);
		echo '<div class="alert alert-success" role="alert">Chúc mừng bạn đã sửa sản phẩm thành công!</div>';
		die();
	} else {
		//insert
		$sql = "insert into Product(discount_id, brand_id,featured_image, name, description, updated_at, created_date, category_id)
		 values ('$discount_id','$brand_id','$featured_image', '$name', '$description', '$updated_at', '$created_date', $category_id)";
		execute($sql);
		echo '<div class="alert alert-success" role="alert">Chúc mừng bạn đã thêm sản phẩm thành công!</div>';
		die();
	}
}