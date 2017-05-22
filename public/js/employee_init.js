	$(document).ready(function(){

	$("#bio").wysihtml5();
	//iCheck for checkbox and radio inputs
	$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
	checkboxClass: 'icheckbox_minimal-blue',
	radioClass: 'iradio_minimal-blue'
	});
	//Red color scheme for iCheck
	$('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
	checkboxClass: 'icheckbox_minimal-red',
	radioClass: 'iradio_minimal-red'
	});
	//Flat red color scheme for iCheck
	$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
	checkboxClass: 'icheckbox_flat-green',
	radioClass: 'iradio_flat-green'
	});

	$('#date_of_birth').datepicker();
	$('#passport_issue_date').datepicker();
	$('#passport_valid_upto').datepicker();
	$('#offer_date').datepicker();
	$('#confirmation_date').datepicker();
	$('#date_of_joining').datepicker();
	$('#retirement_date').datepicker();
	$('#contract_end_date').datepicker();
	$('#final_leave_encashed_date').datepicker();


	var department_branch_id=$('#department_branch_id'); 
	parameters = { 
	placeholder: "Job Branch",
	url: '{{URL::to("/")}}/branch/auto/get_branchs',
	selector_id:department_branch_id, 
	data:{}
	}

	init_select2(parameters);

	var department_id=$("#department_id");
	parameters = {
	placeholder: "Post Office",
	url: '{{URL::to("/")}}/branch/auto/get_departments',
	selector_id:department_id,
	value_id:$('#department_branch_id')
	}

	// initialize select2 for post_office_id
	init_select2_with_one_parameter(parameters);

	var designation_id=$('#designation_id'); 
	parameters = { 
	placeholder: "Job Applicant",
	url: '{{URL::to("/")}}/designation/auto/get_designations',
	selector_id:designation_id, 
	data:{}
	}

	init_select2(parameters);


	var holiday_list_id=$('#holiday_list_id'); 
	parameters = { 
	placeholder: "Holiday List",
	url: '{{URL::to("/")}}/holiday/auto/get_holiday_lists',
	selector_id:holiday_list_id, 
	data:{}
	}

	init_select2(parameters);

	var week_holiday_master_id=$('#week_holiday_master_id'); 
	parameters = { 
	placeholder: "Week Holiday",
	url: '{{URL::to("/")}}/week_holiday/auto/get_week_holiday_masters',
	selector_id:week_holiday_master_id, 
	data:{}
	}

	init_select2(parameters);

	var salary_grade_master_id=$('#salary_grade_master_id'); 
	parameters = { 
	placeholder: "Salary Grade Holiday",
	url: '{{URL::to("/salary_grade/auto/get_salary_grades")}}',
	selector_id:salary_grade_master_id, 
	data:{}
	}

	init_select2(parameters);

	});