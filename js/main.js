var
    pages           = [],
    acc_controls    = [],
    url_params      = [],
    load_progress   = 0;

$(document).ready(function() {
    var resources = {title: 'Resources',
                     links: [
                     'Dropbox',
                     'Debate Videos',
                     'New Computer Setup']};
    if($.ajax({
        type: 'get',
        url: '/main.php',
        data: {
            util: 'logged_in'
        },
        async: false
    }).responseText == '1') {
            pages = [
                'Tournaments',
                'Members',
                'Checkout',
                resources
            ];
            acc_controls = [
                {'name': 'Hello, ' + $.ajax({type:'get',url:'/main.php',data:{util:'name',attr:{type:'first'}},async:false}).responseText, 'id': 'profile'},
                {'name': 'Sign out', 'id': 'signout'}
            ];
        } else {
            pages = [
                'Tournaments', resources
            ];
            acc_controls = [
                {'name': 'Sign in', 'id': 'signin'}
            ];
        };

    $('#navbar-left').html(_.template($('#left-nav-template').html(), pages));
    $('#navbar-right').html(_.template($('#right-nav-template').html(), acc_controls));

    var url  = $.url();
    var p    = url.segment(1);

    $('#loadbar').loadie();

    $.ajax({
        type: 'get',
        url: '/main.php',
        data: {
                page: p
        }
    }).done(function(data) {
        if(data != 'refresh') {
            $('#main').html(data);
        } else {
            window.location('home');
        }
    });

    $('.nav-item').on('click', function(e) {
        clear_notifications();
        $('.nav-item').each(function(i) {
            $(this).removeClass('active');
        });
        $(this).addClass('active');
        e.preventDefault();
        current = $(this).attr('href').split('#')[1].replace(/ /g, '-').toLowerCase();
        history.pushState({}, '', '/' + current + '/');
        $('#loadbar').loadie(.1);
        $('.loadie').fadeIn();
        $.ajax({
            type: 'get',
            url: '/main.php',
            data: {
                page: current
            }
        }).done(function(data) {
            if(data != 'refresh') {
                $('#main').html(data);
                setTimeout(function() {
                    $('#loadbar').loadie(1);
                }, 200)
            } else {
                window.location = '/home/';
            }
        });
    });

    $('#sign-out').on('click', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'get',
            url: '/main.php',
            data: {
                util: 'sign_out'
            }
        }).done(function(data) {
            window.location = '/home/';
        });
    });

    $('#about').on('click', function(e) {
        e.preventDefault();
        $('#loadbar').loadie(.1);
        $('.loadie').fadeIn();
        history.pushState({}, '', '/about/');
        $.ajax({
            type: 'get',
            url: '/main.php',
            data: {
                page: 'about'
            }
        }).done(function(data) {
            $('#main').html(data);
            setTimeout(function() {
                $('#loadbar').loadie(1);
            }, 200)
        });
    });
});