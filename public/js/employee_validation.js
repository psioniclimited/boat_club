$(document).ready(function(){

    // initialize tooltipster on form input elements
    $('form input, select,textarea,file').tooltipster({// <-  USE THE PROPER SELECTOR FOR YOUR INPUTs
        trigger: 'custom', // default is 'hover' which is no good here
        onlyOne: false, // allow multiple tips to be open at a time
        position: 'right'  // display the tips to the right of the element
      });

    $('#add_employe_form').validate({
      highlight : function(label) {
        $(label).closest('.form-group').addClass('has-error');
        var tab_content= $(label).parent().parent().parent().parent().parent().parent().parent();
        if ($(tab_content).find("fieldset.tab-pane.active:has(div.has-error)").length == 0) {                   
         $(tab_content).find("fieldset.tab-pane:has(div.has-error)").each(function (index, tab) {
          var id = $(tab).attr("id");
          $('a[href="#' + id + '"]').tab('show');
        });
       }
     },
     ignore: [],
      // errorPlacement: function (error, element) { 
      //   var lastError = $(element).data('lastError'),
      //   newError = $(error).text();

      //   $(element).data('lastError', newError);

      //   if (newError !== '' && newError !== lastError) {
      //     $(element).tooltipster('content', newError);
      //     $(element).tooltipster('show');
      //   }
      // },
      // success: function (label, element) {
      //   // $(element).tooltipster('hide');
      //   label
      //   .text('OK!').addClass('valid')
      //   .closest('.form-element').addClass('success');
      // },  
      success: function (label) { 
        // label.text('OK!').addClass('valid').closest('.form-element').addClass('success');
        // label.text('OK!').closest('.form-group').removeClass('has-error');
        label.closest('.form-group').removeClass('has-error');
      },
      rules: {
        employee_code: {required: true},
        employee_fullname: {required: true},
        contact_number: {required: true},
        date_of_birth: {required: true},
        present_address: {required: true},
        permanent_address: {required: true}, 
        date_of_joining: {required: true}, 
        retirement_date: {required: true}, 
        department_branch_id: {required: true}, 
        department_id: {required: true}, 
        designation_id: {required: true}, 
        holiday_list_id: {required: true}, 
        week_holiday_master_id: {required: true}, 
        work_shift_id: {required: true}, 
        salary_grade_master_id: {required: true}, 
        basic_salary: {required: true}, 
        attendance_deduction_master_id: {required: true}, 
        leave_package_id: {required: true}, 
      },
      messages: {
        employee_code: {required: "Please give Employee Code"},  
        employee_fullname: {required: "Please give Employee Name"},
        contact_number: {required: "Please give Employee's Contact Number"},
        date_of_birth: {required: "Please give Employee's Date Of Birth"},
        present_address : {required: "Please give Employee's Present Address"},
        permanent_address : {required: "Please give Employee's Permanent Address"}, 
        date_of_joining : {required: "Please give Employee's Joining Date"}, 
        retirement_date : {required: "Please give Employee's Retirement Date"}, 
        department_branch_id : {required: "Please give Employee's Branch Name"}, 
        department_branch_id : {required: "Please give Employee's Department Name"}, 
        department_branch_id : {required: "Please give Employee's Branch Name"}, 
        holiday_list_id : {required: "Please give Employee's Holiday List"}, 
        week_holiday_master_id : {required: "Please give Employee's Week Holiday"}, 
        work_shift_id : {required: "Please give Employee's Work Shift"}, 
        salary_grade_master_id : {required: "Please give Employee's Salary Grade"}, 
        basic_salary : {required: "Please give Employee's Basic Salary"}, 
        attendance_deduction_master_id : {required: "Please give Attendance Deduction Policy"}, 
        leave_package_id : {required: "Please give Leave Package Policy"}, 
      }
    });





  });