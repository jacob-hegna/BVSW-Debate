var
    pages        = [],
    acc_controls = [];

$(document).ready(function() {
    if($.ajax({
        type: 'post',
        url: 'main.php',
        data: {logged_in: ''},
        async: false
    }).responseText == '1') {
            pages = [
                'Tournaments',
                'Members'
            ];
            acc_controls = [
                {'name': 'Hello, ' + $.ajax({type:'post',url:'main.php',data:{name:'first'},async:false}).responseText, 'id': 'profile'},
                {'name': 'Sign out', 'id': 'sign-out'}
            ];
        } else {
            pages = [
                'Tournaments'
            ];
            acc_controls = [
                {'name': 'Sign in', 'id': 'sign-in'}
            ];
        };

    $('#navbar-left').html(_.template($('#left-nav-template').html(), pages));
    $('#navbar-right').html(_.template($('#right-nav-template').html(), acc_controls));

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
        clear_notifications();
        $('.nav-item').each(function(i) {
            $(this).removeClass('active');
        });
        $(this).addClass('active');
        e.preventDefault();
        current = $(this).attr('href').replace('#', '').toLowerCase();
        $.ajax({
            type: 'post',
            url: 'main.php',
            data: {
                page: $(this).attr('href').replace('#', '').toLowerCase()
            }
        }).done(function(data) {
            $('#main').html(data);
        });
    });

    $('#sign-in').on('click', function(e) {
        $('.nav-item').each(function(i) {
            $(this).removeClass('active');
        });
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: 'main.php',
            data: {
                page: 'sign_in'
            }
        }).done(function(data) {
            $('#main').html(data);
        });
    });

    $('#sign-out').on('click', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: 'main.php',
            data: {
                sign_out: ''
            }
        }).done(function(data) {
            window.location = '';
        });
    });

    $('#profile').on('click', function(e) {
        $('.nav-item').each(function(i) {
            $(this).removeClass('active');
        });
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: 'main.php',
            data: {
                page: 'profile'
            }
        }).done(function(data) {
            $('#main').html(data);
        });
    });
});