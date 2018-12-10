// <!-- Page-Level Demo Scripts - Tables - Use for reference -->

jQuery(document).ready(function($) {
    $('#data_table').DataTable({     
    "fnDrawCallback": function (oSettings) {
           $('.dataTables_scrollBody').slimScroll({
            height: '400px'
        });
       },  
        orderCellsTop: true,
        responsive : true,  
        stateSave: false,  
        "stateSaveParams": function (settings, data) {
            data.search.search = "";
        },
        "iDisplayLength": 10,
        "bJQueryUI": true,
        "autoWidth": true,

        "sScrollY" : "400px",    

        // "dom" : '<"top"i>rt<"bottom"flp><"clear">',

    });
    var table = $('#data_table').DataTable();
    table.columns.adjust().draw();

});

// The following code is for the search on the top applicable
// datable initialization, for this there must be a additional 'tr' 
// in 'thead' of table
// and the id of the additional 'tr' in the thead must be 'filterrow'
jQuery(document).ready(function($) {
    // Setup - add a text input to each footer cell
    $('.dataTables_scrollHeadInner thead tr#filterrow th').each( function () {
        var title = $('#data_table thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" style="width:90%;" onclick="stopPropagation(event);" placeholder="Search '+title+'" />' );
    } );

    // DataTable
    var table = $('#data_table').DataTable();

    // Apply the filter
    $(".dataTables_scrollHeadInner thead input").on( 'keyup change', function () {
        table
        .column( $(this).parent().index()+':visible' )
        .search( this.value )
        .draw();
    } );

    function stopPropagation(evt) {
        if (evt.stopPropagation !== undefined) {
            evt.stopPropagation();
        } else {
            evt.cancelBubble = true;
        }
    }

});


// THE code below is for the footer columnwise searching 
// for this there must be a footer in the html table
/*
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('.dataTables_scrollFootInner tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
 
    // DataTable
    var table = $('#data_table').DataTable();
 
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
} );



*/