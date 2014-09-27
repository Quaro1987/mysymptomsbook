//global variable
var alertTrigger = 0;
//polling for updates function
function pollForNotifications(){
	//ajax url
	var ajaxNotificationsUrl = 'http://localhost/mysymptomsbook/index.php?r=doctorRequests/getNotifications';
	//placeholder data
	var data = 'something';
	
	setTimeout(function() {
		//ajax call to get notifications
		$.ajax({
		   		type: 'POST',
		    	url: ajaxNotificationsUrl,
		   		data:data,
				success:function(dataReturn){
					//if there is a notification run commands to notify the user
					if (dataReturn==1)
					{	
						$('#manageRequestsLink').addClass('notification');
		            	if(alertTrigger==0)
		            	{
		            		alertTrigger = 1;
		            		$('#notificationSound').trigger('play');
		            		$('#alertImg').show();

		            	}
		            }
		        },
		   		error: function() {
		            alert("Error occured.please try again");
		    	},
		    	dataType: 'html',
		    	complete: pollForNotifications()
  		});
  	}, 5000);
};
//function that will start the polling process
$(document).ready(function(){
	$('#manageRequestsLink a').append('<img id="alertImg" src="images/alert.png" />');
	pollForNotifications();
});