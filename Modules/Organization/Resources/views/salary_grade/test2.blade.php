<!DOCTYPE html>
<html>
<head>
	<title>sadasdsa</title> 
	<!-- <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.14/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.2/css/select.bootstrap.min.css">

	<link rel="stylesheet" href="{{asset('editor_datatable')}}/css/editor.bootstrap.css">  	


	<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.4.js">
	</script>
	<script type="text/javascript" language="javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.14/js/jquery.dataTables.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.14/js/dataTables.bootstrap.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.bootstrap.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/select/1.2.2/js/dataTables.select.min.js">
	</script>


	<script src="{{asset('editor_datatable')}}/js/dataTables.editor.js"></script>
	<script src="{{asset('editor_datatable')}}/js/editor.bootstrap.min.js"></script>

<script type="text/javascript" class="init">
	


var editor; // use a global for the submit and return data rendering in the examples

$(document).ready(function() {
	editor = new $.fn.dataTable.Editor( {
		ajax: "https://api.myjson.com/bins/t95m1",
		table: "#example",
		fields: [ {
				label: "First name:",
				name: "first_name"
			}, {
				label: "Last name:",
				name: "last_name"
			}, {
				label: "Position:",
				name: "position"
			}, {
				label: "Office:",
				name: "office"
			}, {
				label: "Extension:",
				name: "extn"
			}, {
				label: "Start date:",
				name: "start_date",
				type: 'datetime'
			}, {
				label: "Salary:",
				name: "salary"
			}
		]
	} );

	var table = $('#example').DataTable( {
		lengthChange: false,
		ajax: "https://api.myjson.com/bins/t95m1",
		columns: [
			{ data: null, render: function ( data, type, row ) {
				// Combine the first and last names into a single table field
				return data.first_name+' '+data.last_name;
			} },
			{ data: "position" },
			{ data: "office" },
			{ data: "extn" },
			{ data: "start_date" },
			{ data: "salary", render: $.fn.dataTable.render.number( ',', '.', 0, '$' ) }
		],
		select: true
	} );

	// Display the buttons
	new $.fn.dataTable.Buttons( table, [
		{ extend: "create", editor: editor },
		{ extend: "edit",   editor: editor },
		{ extend: "remove", editor: editor }
	] );

	table.buttons().container()
		.appendTo( $('.col-sm-6:eq(0)', table.table().container() ) );
} );



	</script>

</head>
<body>
	

				<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Name</th>
							<th>Position</th>
							<th>Office</th>
							<th>Extn.</th>
							<th>Start date</th>
							<th>Salary</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>Name</th>
							<th>Position</th>
							<th>Office</th>
							<th>Extn.</th>
							<th>Start date</th>
							<th>Salary</th>
						</tr>
					</tfoot>
				</table>
	
</body>
</html>