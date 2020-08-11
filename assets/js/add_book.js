// process the form
$('form').submit(function (event) {

    var formData = {
        'title': $('#title').val(),
        'author': $('#author').val(),
        'category': $('#category').val(),
        'image_url': $('#imageUrl').val(),
        'count': $('#count').val(),
        'price': $('#price').val(),
        'description': $('#description').val()
    };

    // process the form
    $.ajax({
        type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
        url: '<?php echo site_url('dashboard/ add_book_details') ?>', // the url where we want to POST
        data: formData, // our data object
        dataType: 'json', // what type of data do we expect back from the server
        encode: true,
        success: function showModal() {
            $("#myModal .modal-content").html();
            $('#myModal').modal('show');
        }
    })
    // using the done promise callback
    .done(function (data) {

        // log data to the console so we can see
        console.log(data);

        // here we will handle errors and validation messages
        if (!data.success) {


        } else {

        }
    })

    // using the fail promise callback
    .fail(function (data) {

        // show any errors

    });

// stop the form from submitting the normal way and refreshing the page
event.preventDefault();
});

});