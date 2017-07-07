<div class="container theme-showcase" role="main" style="margin-top: 80px">
<?php
	$module = (isset($_REQUEST["module"]) ? $_REQUEST["module"] : "main");
	$action = (isset($_REQUEST["action"]) ? $_REQUEST["action"] : "index");
	$include = "Modules/".$module."/".$action.".php";
	require_once($include);
?>
</div>