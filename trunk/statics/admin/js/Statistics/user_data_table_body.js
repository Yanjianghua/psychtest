$(function() {
	$('#data_table_body').datagrid({
		nowrap: true,
		width: 1000,
		striped: true,
		ctrlSelect: true,
		columns: [
			[{
				field: 'username',
				title: '用户名',
				width: 180,
				align: 'center'
			}, {
				field: 'total',
				title: '发布',
				width: 80,
				align: 'center'
			}, {
				field: 'included',
				title: '收录',
				width: 80,
				align: 'center'
			}, {
				field: 'calc',
				title: '收录率',
				width: 80,
				align: 'center'
			}, {
				field: 'home',
				title: '首页排名',
				width: 80,
				align: 'center'
			}, {
				field: 'homecalc',
				title: '首页排名率',
				width: 80,
				align: 'center'
			}]
		]
	});
});