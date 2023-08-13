$(document).ready(function(){

  $('.showbtn').on('mousedown', function(){
    $(this).closest("tr").find("input[type='password']").attr('type', 'text');
  });

  $('.showbtn').on('mouseup', function(){
    $(this).closest("tr").find("input[type='text']").attr('type', 'password');
  });

  $('.removebtn').on('click', function(){
    var token = $(this).attr('id');
    var url = "remove.php?token=" + token;
    window.location.href = url;
  });

  $('.removecard').on('click', function(){
    var cardtoken = $(this).attr('id');
    var url = "remove.php?cardtoken=" + cardtoken;
    window.location.href = url;
  });


});