@extends('layouts.master')
@section('css')  

<link rel="stylesheet" href="{{asset('bower_components/AdminLTE')}}/plugins/datatables/jquery.dataTables.css">
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE')}}/plugins/datatables/dataTables.bootstrap.css">  
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE')}}/plugins/datatables/extensions/buttons/css/buttons.bootstrap.min.css"> 
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE')}}/plugins/datatables/extensions/select/css/select.dataTables.min.css">  

 

<link rel="stylesheet" href="{{asset('editor_datatable')}}/css/editor.bootstrap.css">   
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE')}}/plugins/datatables/extensions/buttons/css/buttons.dataTables.min.css">  
<link rel="stylesheet" href="{{asset('editor_datatable')}}/css/editor.bootstrap.css">  
<link rel="stylesheet" href="{{asset('editor_datatable')}}/css/dataTables.editor.css">  

<!-- <link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/select2/select2.min.css')}}"> -->
<link rel="stylesheet" href="{{asset('editor_datatable/select2/css/select2.min.css')}}">

<style>
  .paginate_button{
    padding: 0px !important;
    margin: 0px !important;
  }
</style>


@endsection
@section('content')

<!-- Main content -->
<section class="content">
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
</section>
<!-- /.content -->


@endsection


@section('scripts')  

 

<script src="{{asset('bower_components/AdminLTE')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('bower_components/AdminLTE')}}/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="{{asset('bower_components/AdminLTE')}}/plugins/datatables/extensions/buttons/js/dataTables.buttons.min.js"></script>
<script src="{{asset('bower_components/AdminLTE')}}/plugins/datatables/extensions/buttons/js/buttons.bootstrap.min.js"></script>
<script src="{{asset('bower_components/AdminLTE')}}/plugins/datatables/extensions/select/js/dataTables.select.min.js"></script>

 

<!-- <script src="{{asset('bower_components/AdminLTE//plugins/select2/select2.min.js')}}"></script> -->
<script src="{{asset('editor_datatable/select2/js/select2.min.js')}}"></script>

<script src="{{asset('editor_datatable')}}/js/dataTables.editor.js"></script>
<script src="{{asset('editor_datatable')}}/js/editor.bootstrap.min.js"></script>
<script src="{{asset('js/utils/utils.js')}}"></script>




<script>
var editor; // use a global for the submit and return data rendering in the examples


  
(function( factory ){
    if ( typeof define === 'function' && define.amd ) {
        // AMD
        define( ['jquery', 'datatables', 'datatables-editor'], factory );
    }
    else if ( typeof exports === 'object' ) {
        // Node / CommonJS
        module.exports = function ($, dt) {
            if ( ! $ ) { $ = require('jquery'); }
            factory( $, dt || $.fn.dataTable || require('datatables') );
        };
    }
    else if ( jQuery ) {
        // Browser standard
        factory( jQuery, jQuery.fn.dataTable );
    }
}(function( $, DataTable ) {
'use strict';
 
 
if ( ! DataTable.ext.editorFields ) {
    DataTable.ext.editorFields = {};
}
 
var _fieldTypes = DataTable.Editor ?
    DataTable.Editor.fieldTypes :
    DataTable.ext.editorFields;
 
 
_fieldTypes.select2 = {
    _addOptions: function ( conf, opts ) {
        var elOpts = conf._input[0].options;
 
        elOpts.length = 0;
 
        if ( opts ) {
            DataTable.Editor.pairs( opts, conf.optionsPair, function ( val, label, i ) {
                elOpts[i] = new Option( label, val );
            } );
        }
    },
 
    create: function ( conf ) {
        conf._input = $('<select/>')
            .attr( $.extend( {
                id: DataTable.Editor.safeId( conf.id )
            }, conf.attr || {} ) );
 
        var options = $.extend( {
                width: '100%'
            }, conf.opts );
 
        _fieldTypes.select2._addOptions( conf, conf.options || conf.ipOpts );
        conf._input.select2( options );
 
        var open;
        conf._input
            .on( 'select2:open', function () {
                open = true;
            } )
            .on( 'select2:close', function () {
                open = false;
            } );
 
        // On open, need to have the instance update now that it is in the DOM
        this.one( 'open.select2-'+DataTable.Editor.safeId( conf.id ), function () {
            conf._input.select2( options );
 
            if ( open ) {
                conf._input.select2( 'open' );
            }
        } );
 
        return conf._input[0];
    },
 
    get: function ( conf ) {
        var val = conf._input.val();
 
        return conf._input.prop('multiple') && val === null ?
            [] :
            val;
    },
 
    set: function ( conf, val ) {
        // The value isn't present in the current options list, so we need to add it
        // in order to be able to select it. Note that this makes the set action async!
        // It doesn't appear to be possible to add an option to select2, then change
        // its label and update the display
        if ( conf.opts && conf.opts.ajax && conf._input.find('options:attr(value["'+val+'"])').length === 0 ) {
            $.ajax( $.extend( {
                data: {
                    initialValue: true,
                    value: val
                },
                success: function ( json ) {
                    $('<option/>')
                        .attr('value', val)
                        .text( json.text )
                        .appendTo( conf._input );
 
                    conf._input
                        .val( val )
                        .trigger( 'change', {editor: true} );
                }
            }, conf.opts.ajax ) );
        }
        else {
            conf._input
                .val( val )
                .trigger( 'change', {editor: true} );
        }
    },
 
    enable: function ( conf ) {
        $(conf._input).removeAttr( 'disabled' );
    },
 
    disable: function ( conf ) {
        $(conf._input).attr( 'disabled', 'disabled' );
    },
 
    // Non-standard Editor methods - custom to this plug-in
    inst: function ( conf ) {
        var args = Array.prototype.slice.call( arguments );
        args.shift();
 
        return conf._input.select2.apply( conf._input, args );
    },
    update: function ( conf, data ) {
        var val = _fieldTypes.select2.get( conf );
 
        _fieldTypes.select2._addOptions( conf, data );
 
        // Restore null value if it was, to let the placeholder show
        if ( val === null ) {
            _fieldTypes.select2.set( conf, null );
        }
 
        $(conf._input).trigger('change', {editor: true} );
    },
 
    focus: function ( conf ) {
        conf._input.select2('open');
    }
};
 
 
}));


$(document).ready(function() {

   editor = new $.fn.dataTable.Editor( {
        // ajax: "../php/staff.php",
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
          name: "extn",
          type:"select2",
         // options: [
         //     { "label": "1 (highest)", "value": "1" },
         //     { "label": "2",           "value": "2" },
         //     { "label": "3",           "value": "3" },
         //     { "label": "4",           "value": "4" },
         //     { "label": "5 (lowest)",  "value": "5" }
         // ]

          opts: {
            multiple: true,
            placeholder: 'Select one or more recipients',
            // minimumInputLength: 3,
            ajax:{
              url: "{{URL::to("/")}}/branch/auto/get_districts",
              dataType: 'json',
              delay: 250,
              data: function (params) {
                return {q: params.term};
              },
              processResults: function (data, params) {
                return {results: data.results};
              },
              cache: true
            }
          }

        }, {
          label: "Start date:",
          name: "start_date",
          type: "datetime"
        }, {
          label: "Salary:",
          name: "salary"
        }
        ]
      } );

  var table = $('#example').DataTable( {
    dom: "Bfrtip",
    ajax: "https://api.myjson.com/bins/t95m1",
    columns: [
    { data: "first_name" },
    { data: "last_name" },
    { data: "position" },
    { data: "office" },
    { data: "start_date" },
    { data: "salary", render: $.fn.dataTable.render.number( ',', '.', 0, '$' ) }
    ],
    autoFill: {
      editor:  editor
    },
    select: {
      style:    'os',
      selector: 'td:first-child',
      blurable: true
    },
    buttons: [
    { extend: "create", editor: editor },
    { extend: "edit",   editor: editor },
    { extend: "remove", editor: editor }
    ]
  } );

} );
</script>

@endsection
