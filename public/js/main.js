$(function(){
  $( "#datepicker1" ).datepicker({dateFormat: "yy-mm-dd"});
  $( "#datepicker2" ).datepicker({dateFormat: "yy-mm-dd"});
  $("#divShow").hide();
  $('body').click(function(evt) {
    if($(evt.target).parents("#divShow").length==0 &&
      evt.target.id != "aaa" && evt.target.id != "divShow") {
      $('#divShow').hide();
    }
  });
});
