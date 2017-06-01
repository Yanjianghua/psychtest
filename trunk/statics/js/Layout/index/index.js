$(function() {
	$('#tree_menu').tree({
		onClick: function(node) {
			if (node.attributes && 'url' in node.attributes) {
				$('#sys_main').attr('src', node.attributes.url);
			}
		}
	});
});