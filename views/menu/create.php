<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */
use fec\helpers\CRequest;
?>
<div class="pageContent">
	
	<form method="post" action="<?= $editSaveUrl ; ?>" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDoneCloseAndReflush);">
		<div class="pageFormContent" layoutH="58">
			<?php echo CRequest::getCsrfInputHtml();  ?>	
			<div class="unit">
				<label>ParentId:</label>
				<input type="text" name="editFormData[parent_id]" size="30"  class="create_parent_id textInput readonly" />
			</div>
			<div class="unit">
				<label>上级菜单：</label>
				<input type="text" name="patientNames" size="30" class="create_parent_menu textInput"/>
			</div>
			<div class="unit">
				<label>Name:</label>
				<input type="text" name="editFormData[name]" size="30"  class="textInput require" />
			</div>
			<div class="unit">
				<label>UrlKey:</label>
				<input type="text" name="editFormData[url_key]" size="30"  class="textInput require" />
			</div>
			
		</div>
		<div class="formBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">提交</button></div></div></li>
				<li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
			</ul>
		</div>
	</form>
	
</div>

<script>
$(".create_parent_id").val($(".current_parent_id").val());
parent_menu_name = $(".current_parent_menu_name").val();
if(!parent_menu_name){
	parent_menu_name = 'Root Category';
}
$(".create_parent_menu").val(parent_menu_name);

</script>
					