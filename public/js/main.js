

$(document).ready(function(){

//


	$('body').delegate('.dayOfModal' , 'click' , function(){
		$('.modalForShowingInfo').addClass('show')

	})
	$('body').delegate('.close span' , 'click' , function(){
		$('.modalForShowingInfo').removeClass('show');
		$('#customers .tr_modal').remove();
	})

    $('.report_save').click(function () {

        var report = $('.selected #textarea').val();
        var data_date = $('.selected').attr('data-date');
        if(data_date.length === 1){data_date = '0'+data_date;}
        var data_month = $('.selected').attr('data-month');
        if(data_month.length === 1){data_month = '0'+data_month;}
        var data_year = $('.selected').attr('data-year');
        var data = data_year+'-'+data_month+'-'+data_date
        var id = $('#code').val();
        $.ajax({
            type: 'get',
            url: '/add',

            data: {
               id: id,
                report: report,
                data: data,
            },
            success: function (data) {
                // alert(true)
                location.reload();
                // if(data.data.success){
                //     //do something
                // }
            }
        });
    })

    $('#user_name').change(function () {
        $('#form_user').submit();
    });

	$('.dayOfModal').click(function () {
        var value = $( "#user_name" ).val();
        var data_date = $(this).parent().attr('data-date');
        if(data_date.length === 1){data_date = '0'+data_date;}
        var data_month = $(this).parent().attr('data-month');
        if(data_month.length === 1){data_month = '0'+data_month;}
        var data_year = $(this).parent().attr('data-year');
        var data = data_year+'-'+data_month+'-'+data_date;
        var user_id =  $( "#user_name" ).val();

        $.ajax({
            async: false,
            type: 'get',
            url: '/data_date',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {
                user_id: user_id,
                data: data,
            },
            success: function (data) {
                console.log(data.report)
                Object.keys(data.report).forEach(function (k) {
                        var td_name = '<tr class="tr_modal"><td class="name_modal"> <p>' + data.report[k]['user']['name'] + '</p> </td><td class="date_modal"> <p>' + data.report[k]['date'] + '</p> </td> <td class="text_modal"> <p>' + data.report[k]['user_report'] + '</p> </td></tr>';
                    $('#customers').append(td_name)
                })

            }
        });
    });

    $('#next').click(function () {
        var value = $( "#user_name" ).val();
        var data_date = $('#day').val();
        alert(data_date)


        if(data_date.length === 1){data_date = '0'+data_date;}
        var data_month = $('.selected').attr('data-month');
        if(data_month.length === 1){data_month = '0'+data_month;}
        var data_year = $('.selected').attr('data-year');
        var data = data_year+'-'+data_month+'-'+data_date
        var user_id =  $( "#user_code" ).val();

        $.ajax({
            async: false,
            type: 'get',
            url: '/next',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {
                user_id: user_id,
                data: data,
            },
            success: function (data) {
                console.log(data.report)
                Object.keys(data.report).forEach(function (k) {
                    var td_name = '<tr class="tr_modal"><td class="name_modal"> <p>' + data.report[k]['user']['name'] + '</p> </td><td class="date_modal"> <p>' + data.report[k]['date'] + '</p> </td> <td class="text_modal"> <p>' + data.report[k]['user_report'] + '</p> </td></tr>';
                    $('#customers').append(td_name)
                })

            }
        });
    }) ;
    // $('#prev').click(function () {
    //     var value = $( "#user_name" ).val();
    //     var data_date = $('#day').val();
    //     if(data_date.length === 1){data_date = '0'+data_date;}
    //     var data_month = $('.selected').attr('data-month');
    //     if(data_month.length === 1){data_month = '0'+data_month;}
    //     var data_year = $('.selected').attr('data-year');
    //     var data = data_year+'-'+data_month+'-'+data_date
    //     var user_id =  $( "#user_code" ).val();
    //
    //     $.ajax({
    //         async: false,
    //         type: 'get',
    //         url: '/prev',
    //         contentType: "application/json; charset=utf-8",
    //         dataType: "json",
    //         data: {
    //             user_id: user_id,
    //             data: data,
    //         },
    //         success: function (data) {
    //             console.log(data.report)
    //             Object.keys(data.report).forEach(function (k) {
    //                 var td_name = '<tr class="tr_modal"><td class="name_modal"> <p>' + data.report[k]['user']['name'] + '</p> </td><td class="date_modal"> <p>' + data.report[k]['date'] + '</p> </td> <td class="text_modal"> <p>' + data.report[k]['user_report'] + '</p> </td></tr>';
    //                 $('#customers').append(td_name)
    //             })
    //
    //         }
    //     });
    // })


    });
