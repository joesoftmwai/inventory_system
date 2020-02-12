/**
 * :: LOCALSTORAGE CHECK
 */

if(localStorage.getItem('_dateRange') != null) {
    $('#_daterange-btn span').html(localStorage.getItem('_dateRange'));
 } else {
    $('#_daterange-btn span').html('<i class="fa fa-calendar"></i> Date range <i class="fa fa-caret-down"></i>');
 }



 /**
  * :: DATE RANGE PICKER
  */

// Date range as a button
$('#_daterange-btn').daterangepicker(
    {
        ranges   : {
        'Today'       : [moment(), moment()],
        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment(),
        endDate  : moment()
    },
    function (start, end) {
        $('#_daterange-btn span').html(start.format('MMMM DD, YYYY') + ' - ' + end.format('MMMM DD, YYYY'))
    
        var startDate = start.format('YYYY-MM-DD');
        var endDate = end.format('YYYY-MM-DD');
        var _dateRange =  $('#_daterange-btn span').html();
      
        localStorage.setItem('_dateRange', _dateRange);
        window.location = "index.php?route=reports&startDate="+startDate+"&endDate="+endDate;
    }
    )
    
    /**
     * :: CANCEL DATE RANGE
     */
    
     $('.daterangepicker .range_inputs .cancelBtn').on('click', function() {
        localStorage.removeItem('_dateRange');
        localStorage.clear();
        window.location = 'reports';
     }) ;
    
     /**
      * :: CAPTURE TODAY
      */
     $('.opensright .ranges li').on('click', function() {
    
         var todayText = $(this).attr('data-range-key');

         console.log("todayText", todayText);
         if(todayText=="Today") {
            var date = new Date();
            var year = date.getFullYear();
            var month = date.getMonth()+1;
            var day = date.getDate();
            var today = (year+'-'+month+'-'+day);
            
            if(month < 10) {
                var today = (year+'-0'+month+'-'+day);
            } else if(day < 10) {
                var today = (year+'-'+month+'-0'+day);
            } else if(month < 10 && day < 10) {
                var today = (year+'-0'+month+'-0'+day);
            } else {
                var today = (year+'-'+month+'-'+day);
            }
    
    
            localStorage.setItem("_dateRange", "Today");
    
            window.location="index.php?route=reports&startDate="+today+"&endDate="+today;
         }
    
     }) ;
    