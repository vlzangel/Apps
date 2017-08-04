<!DOCTYPE html>
<html>
    <head>
        <title>jQuery Datepicker</title>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

        <link href='datapicker/jquery.datepick.css' rel='stylesheet'>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="datapicker/jquery.plugin.js"></script>
        <script src="datapicker/jquery.datepick.js"></script>
    </head>

    <body>

       <div class="discussion">
          In this example, I wanted to try to add range selection to the jQuery UI Datepicker.  Its one of the
          features I'm interested in providing to my users.  My preference is to use the jQuery UI widgets when possible
          simply because there is a consistent look-and-feel across the library.  I found other libraries that provide
          the features but do not work as well overall as the jQuery version.
       </div><br/>

       <style>
            .wrapper {
                height: 600px;
            }
             #jrange input {
                width: 200px;
            }
            #jrange div {
                font-size: 9pt;
            }
            .date-range-selected > .ui-state-active,
            .date-range-selected > .ui-state-default {
                background: none;
                background-color: lightsteelblue;
            }
       </style>

       <div class="wrapper">
            <div id="jrange" class="dates">
                <input />
                <div></div>
            </div>
       </div>

        <script>
            $.datepicker._defaults.onAfterUpdate = null;
            var datepicker__updateDatepicker = $.datepicker._updateDatepicker;
            $.datepicker._updateDatepicker = function( inst ) {
            datepicker__updateDatepicker.call( this, inst );
            var onAfterUpdate = this._get(inst, 'onAfterUpdate');
            if (onAfterUpdate)
                onAfterUpdate.apply((inst.input ? inst.input[0] : null), [(inst.input ? inst.input.val() : ''), inst]);
            }
            $(function() {
            var cur = -1, prv = -1;
            $('#jrange div').datepicker({
                    //numberOfMonths: 3,
                    changeMonth: true,
                    changeYear: true,
                    showButtonPanel: true,
                    beforeShowDay: function ( date ) {
                        return [true, ( (date.getTime() >= Math.min(prv, cur) && date.getTime() <= Math.max(prv, cur)) ? 'date-range-selected' : '')];
                    },
                    onSelect: function ( dateText, inst ) {
                          var d1, d2;
                          prv = cur;
                          cur = (new Date(inst.selectedYear, inst.selectedMonth, inst.selectedDay)).getTime();
                          if ( prv == -1 || prv == cur ) {
                             prv = cur;
                             $('#jrange input').val( dateText );
                          } else {
                             d1 = $.datepicker.formatDate( 'mm/dd/yy', new Date(Math.min(prv,cur)), {} );
                             d2 = $.datepicker.formatDate( 'mm/dd/yy', new Date(Math.max(prv,cur)), {} );
                             $('#jrange input').val( d1+' - '+d2 );
                          }
                    },
                    onChangeMonthYear: function ( year, month, inst ) {
                          //prv = cur = -1;
                    },
                    onAfterUpdate: function ( inst ) {
                        $('<button type="button" class="ui-datepicker-close ui-state-default ui-priority-primary ui-corner-all" data-handler="hide" data-event="click">Done</button>')
                            .appendTo($('#jrange div .ui-datepicker-buttonpane'))
                            .on('click', function () { 
                                $('#jrange div').hide(); 
                            });
                   }
            }).position({
                my: 'left top',
                at: 'left bottom',
                of: $('#jrange input')
            }).hide();
                $('#jrange input').on('focus', function (e) {
                    var v = this.value, d;
                    try {
                        if ( v.indexOf(' - ') > -1 ) {
                            d = v.split(' - ');
                            prv = $.datepicker.parseDate( 'mm/dd/yy', d[0] ).getTime();
                            cur = $.datepicker.parseDate( 'mm/dd/yy', d[1] ).getTime();
                        } else if ( v.length > 0 ) {
                            prv = cur = $.datepicker.parseDate( 'mm/dd/yy', v ).getTime();
                        }
                    } catch ( e ) {
                        cur = prv = -1;
                    }
                    if ( cur > -1 )
                        $('#jrange div').datepicker('setDate', new Date(cur));
                        $('#jrange div').datepicker('refresh').show();
                });
            });
        </script>

    </body>
</html>