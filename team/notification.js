$(document).ready(function(){
 
    function load_unseen_notification(view = '')
    {
     $.ajax({
      url:"fetchNotification.php",
      method:"POST",
      data:{view:view},
      dataType:"json",
      success:function(data)
      {

       $('.notifymenu').html(data.notification);
  
        $('.count').html(data.unseen_notification);

      }
     });
    }
    
    load_unseen_notification();
    
    $(document).on('click', '.notify-click', function(){

     $('.count').html('');
     load_unseen_notification('yes');
    });
    
    setInterval(function(){ 
     load_unseen_notification();; 
    }, 5000);
    
   });