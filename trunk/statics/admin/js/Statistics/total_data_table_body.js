$(function() {
	$('#data_table_body').datagrid({
		nowrap: true,
		width: 1000,
		striped: true,
		ctrlSelect: true,
		columns: [
			[{
				field: 'total',
				title: '发布',
				width: 80,
				align: 'center'
			}]
		]
	});
});