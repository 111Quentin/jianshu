$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
    }
});

$(".post-audit").click(function (event) {
	 var target=$(event.target);
	 var post_id=target.attr("post-id");
	 var status=target.attr("post-action-status");

	 $.ajax({
		 url:"/admin/posts/"+post_id+"/status",
		 method:"post",
		 data:{"status":status},
		 dataType:"json",
		 success:function(data){
			 if(data.error!=0){
			 	alert(data.msg);
			 	return;
			 }
			 target.parent().parent().remove();
         }
	 });
});

 $(".resource-delete").click(function (event) {
     if (confirm("确定执行删除操作么?") == false) {
     return;
     }
     var target=$(event.target);
     event.preventDefault();
     var url=$(target).attr("delete-url");
     $.ajax({
		 url:url,
		 method:"POST",
		 data:{"_method":'DELETE'},
	     dataType:"json",
		 success:function (data) {
			 if(data.error!=0){
			 	alert(date.msg);
			 	return;
			 }
			 window.location.reload();
         }
	 });
 });
