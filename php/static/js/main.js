$(function() {
    $.ajax({
        type: 'post',
        url: 'main.php',
        data: {
                page: 'home'
        }
    }).done(function(data) {
        $('#main').html(data);
    });
    $('.nav-item').on('click', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: 'main.php',
            data: {
                page: $(this).attr('href').replace('#', '')
            }
        }).done(function(data) {
            $('#main').html(data);
        });
    });
    $('#sign-in').on('click', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: 'main.php',
            data: {
                page: 'sign-in'
            }
        }).done(function(data) {
            $('#main').html(data);
        });
    });
})