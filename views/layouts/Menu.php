<?php
namespace fecadmin\views\layouts;
use Yii;
use fec\helpers\CUrl;
use fec\helpers\CProfile;
class Menu{
	

	
	
	public static function getContent(){
		return '<div class="accordionHeader">
					<h2><span>Folder</span>控制面板</h2>
				</div>
				<div class="accordionContent">
					<ul class="tree treeFolder">
						<li><a href="tabsPage.html" target="navTab">用户管理</a>
							<ul>
								<li><a href="dd" target="navTab" rel="main">我的账户</a></li>
								<li><a href="dd" target="navTab" rel="main">账号管理</a></li>
								<li><a href="ddd" target="navTab" rel="page1">权限管理</a></li>
							</ul>
						</li>
						
						<li><a href="ddd" target="navTab" rel="page1">菜单管理</a></li>
					
				
						<li><a href="ddd" target="navTab" rel="page1">操作日志</a></li>
					
						<li><a href="ddd" target="navTab" rel="page1">缓存管理</a></li>
					
					</ul>
				</div>
				<div class="accordionHeader">
					<h2><span>Folder</span>典型页面</h2>
				</div>
				<div class="accordionContent">
					<ul class="tree treeFolder treeCheck">
						<li><a href="demo_page1.html" target="navTab" rel="demo_page1">查询我的客户</a></li>
						<li><a href="demo_page1.html" target="navTab" rel="demo_page2">表单查询页面</a></li>
						<li><a href="demo_page4.html" target="navTab" rel="demo_page4">表单录入页面</a></li>
						<li><a href="demo_page5.html" target="navTab" rel="demo_page5">有文本输入的表单</a></li>
						<li><a href="javascript:;">有提示的表单输入页面</a>
							<ul>
								<li><a href="javascript:;">页面一</a></li>
								<li><a href="javascript:;">页面二</a></li>
							</ul>
						</li>
						<li><a href="javascript:;">选项卡和图形的页面</a>
							<ul>
								<li><a href="javascript:;">页面一</a></li>
								<li><a href="javascript:;">页面二</a></li>
							</ul>
						</li>
						<li><a href="javascript:;">选项卡和图形切换的页面</a></li>
						<li><a href="javascript:;">左右两个互动的页面</a></li>
						<li><a href="javascript:;">列表输入的页面</a></li>
						<li><a href="javascript:;">双层栏目列表的页面</a></li>
					</ul>
				</div>
				<div class="accordionHeader">
					<h2><span>Folder</span>流程演示</h2>
				</div>
				<div class="accordionContent">
					<ul class="tree">
						<li><a href="newPage1.html" target="dialog" rel="dlg_page">列表</a></li>
						<li><a href="newPage1.html" target="dialog" rel="dlg_page2">列表</a></li>
					</ul>
				</div>';
		
	}
	
	
}



?>