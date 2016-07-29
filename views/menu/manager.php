<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */
use yii\helpers\Html;
use fec\helpers\CRequest;
?><style type="text/css">
	ul.rightTools {float:right; display:block;}
	ul.rightTools li{float:left; display:block; margin-left:5px}
</style>


<form id="pagerForm" method="post" action="<?= \fec\helpers\CUrl::getCurrentUrl();  ?>">
	<?=  CRequest::getCsrfInputHtml();  ?>
	
	
</form>

<div class="pageContent" style="padding:5px">
	<div class="panel" defH="40">
		<h1>菜单基本信息</h1>
		<div>
			
			<ul class="leftTools">
				<li>
					<a class="button" target="dialog" 
					rel="<?= $createMenuUrl; ?>" 
					href="<?= $createMenuUrl; ?>" 
					mask="true">
						<span>创建菜单</span>
					</a>
				</li>
				
				<li>
					<a class="button deleteMenu" 
					rel="<?= $deleteMenuUrl; ?>" 
					href="javascript:" 
					mask="true">
						<span>删除菜单</span>
					</a>
					<a class="btnDel btnDelMenu" style="display:none;" href="<?= $deleteMenuUrl; ?>" target="ajaxTodo" title="删除后，菜单对应的所有子菜单都会被删除，确定操作吗？">删除</a>
				</li>
				
				</ul>
		</div>
	</div>
	<script>
		$(".deleteMenu").click(function(){
			current_id = $(".current_parent_id").val();
			if(current_id){
				href = $(this).attr("rel");
				$(".btnDelMenu").attr("href",href+"?id="+current_id).click();
				
			}else{
				alert("you must chose a category to delete");
			}
			
		});
	</script>
	
	<div class="divider"></div>
	<div class="tabs">
		<div>
				<div layoutH="146" style="float:left; display:block; overflow:auto; width:240px; border:solid 1px #CCC; line-height:21px; background:#fff">
				    
					
					<ul class="tree treeFolder">
						<?= $menTreeHtml; ?>
				     </ul>
				</div>
			<form method="post" action="<?= $editMenuUrl ?>" onsubmit="return validateCallback(this,navTabAjaxDone)" rel="pagerForm">
				<?=  CRequest::getCsrfInputHtml();  ?>		
				<div layoutH="146"  id="jbsxBox" class="unitBox pageFormContent" style="margin-left:241px;display:block; overflow:auto; width:auto; border:solid 1px #CCC; line-height:21px; background:#fff">
						
					
				</div>
			</form>
		</div>
		
	</div>
	
</div>


	



