// Placeholders
$('input').focus(function(){
  if($(this).attr('placeholder')&& $(this).val()!=""){
    $('.ph').fadeOut();
    $(this).after('<div class="ph">'+$(this).attr('placeholder')+'</div>');
    $(this).parent().find('.ph').fadeIn();
  }
});
$('input').keyup(function(){
  console.log($(this).val());
  if($(this).attr('placeholder')&&$(this).val!=""){
    $(this).after('<div class="ph">'+$(this).attr('placeholder')+'</div>');
    $(this).parent().find('.ph').fadeIn();
  }
});
$('input').blur(function(){
        $('.ph').fadeOut();
});

$('#verification-box').tooltip({
    placement:'left',
    title:'In order to ensure the only users are actual BVSW debaters, please type the code written on the whiteboard in the debate room.'
});