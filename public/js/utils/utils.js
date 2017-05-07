//this select2 will set a default value as selected in select2
var init_select2 = function(parameters){ 
  var placeholder_text = 'Enter ';
  parameters.selector_id.select2({
    data: [parameters.default_value],
    allowClear: true,
    placeholder: placeholder_text + parameters.placeholder,
    ajax: {
        dataType: 'json',
        url: parameters.url,
        delay: 250,
        data: function(params) {
            return {
                term: params.term, 
                page: params.page,
                data:parameters.data
            }
        },
        processResults: function (data, params) {
            params.page = params.page || 1;
            return {
                results: data,
                pagination: {
                    more: (params.page * 30) < data.total_count
                }
            };
        },
        cache: true
    }
});
} 





var init_select2_with_one_parameter = function(parameters){ 
  var placeholder_text = 'Enter ';
  parameters.selector_id.select2({
    allowClear: true,
    placeholder: placeholder_text + parameters.placeholder,
    ajax: {
        dataType: 'json',
        url: parameters.url,
        delay: 250,
        data: function(params) {
            return {
                term: params.term,
                value_term: parameters.value_id.select2('val'),
                page: params.page
            }
        },
        processResults: function (data, params) {
            params.page = params.page || 1;
            return {
                results: data,
                pagination: {
                    more: (params.page * 30) < data.total_count
                }
            };
        },
        cache: true
    }
});
}  




//this select2 will set a default value as selected in select2
var init_select2_with_default_value = function(parameters){ 
  var placeholder_text = 'Enter ';
  parameters.selector_id.select2({
    data: [parameters.default_value],
    allowClear: true,
    placeholder: placeholder_text + parameters.placeholder,
    ajax: {
        dataType: 'json',
        url: parameters.url,
        delay: 250,
        data: function(params) {
            return {
                term: params.term, 
                page: params.page,
                data:parameters.data
            }
        },
        processResults: function (data, params) {
            params.page = params.page || 1;
            return {
                results: data,
                pagination: {
                    more: (params.page * 30) < data.total_count
                }
            };
        },
        cache: true
    }
});
} 


var init_select2_with_default_value_with_one_parameter = function(parameters){ 
  var placeholder_text = 'Enter ';
  parameters.selector_id.select2({
    data: [parameters.default_value],
    allowClear: true,
    placeholder: placeholder_text + parameters.placeholder,
    ajax: {
        dataType: 'json',
        url: parameters.url,
        delay: 250,
        data: function(params) {
            return {
                term: params.term,
                value_term: parameters.value_id.select2('val'),
                page: params.page
            }
        },
        processResults: function (data, params) {
            params.page = params.page || 1;
            return {
                results: data,
                pagination: {
                    more: (params.page * 30) < data.total_count
                }
            };
        },
        cache: true
    }
});
}  

 