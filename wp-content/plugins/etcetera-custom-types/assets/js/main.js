$(function() {

    $(".submit").on('click', function (){
        let formSuffix = $(this).data('form');
        let form = $('form.'+formSuffix);
        let searchRequest = {};
        let responseDiv = $(".search_results");

        form.find('input[type="text"]').each(function (index){
             let value = $(this).val();
             if (value !== ''){
                 let parameter = $(this).data('parameter');
                 searchRequest[parameter] = value;
             }
        });

        form.find("select").each(function (){
            let value = $(this).val();

            if (value !== '' && value !== '0'){
                let parameter = $(this).data('parameter');
                searchRequest[parameter] = value;
            }
        })

        form.find('input[type="radio"]:checked').each(function (){
            let value = $(this).val();

            if (value !== '' && value !== '0'){
                let parameter = $(this).data('parameter');
                searchRequest[parameter] = value;
            }
        })


        let data = {
            'action': 'filter_immovables',
            'parameters': JSON.stringify(searchRequest),
            'paged': 1,
        };

        sendRequest(data, responseDiv);
    })

    $('a.page-numbers').on('click', function (e){
        e.preventDefault();
        let a = $(this).text();
    })

})

function sendRequest(data, responseDiv){

    $.ajax({
        type: "POST",
        url: '/wp-admin/admin-ajax.php',
        data: data,

        success: function (response) {
            if (response.success) {
                responseDiv.html(response.html);

                $('a.page-numbers').on('click', function (e){
                    e.preventDefault();
                    let paged = $(this).text();

                    if ($(this).hasClass('prev')){
                        paged = Number($('.page-numbers.current').text()) - 1;
                    }

                    if ($(this).hasClass('next')){
                        paged = Number($('.page-numbers.current').text()) + 1;
                    }

                    data.paged = paged;
                    sendRequest(data, responseDiv);
                })
            } else {
                responseDiv.html(response.message);
            }

        },
        error: function(xhr, status, error) {
            responseDiv.html(xhr.responseJSON.message);
        },
    });
}