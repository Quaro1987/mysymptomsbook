//global variables
var alertTrigger = 0;
//ajax url
var ajaxNotificationsUrl = "http://localhost/mysymptomsbook/index.php?r=doctorRequests/getNotifications";
//placeholder data
var data = 'something';
//function to check for notifications when the pages load
function checkForNotificationsOnLoad()
{
	//do ajax call to check if there are already notiifcations in the database
	$.ajax({
		   		type: 'POST',
		    	url: ajaxNotificationsUrl,
		   		data:data,
				success:function(dataReturn){
					//if there is a notification run commands to notify the user
					if (dataReturn==1)
					{	
						$('#manageRequestsLink').addClass('notification');
		            	alertTrigger = 1;
		            }
		        },
		   		error: function() {
		            alert("Error occured.please try again");
		    	},
		    	dataType: 'html',
  		});
}

//polling for updates function
function pollForNotifications()
{		
	setTimeout(function() {
		//ajax call to get notifications
		$.ajax({
		   		type: 'POST',
		    	url: ajaxNotificationsUrl,
		   		data:data,
				success:function(dataReturn){
					//if there is a notification run commands to notify the user
					if (dataReturn==1&&alertTrigger==0)
					{	
						$('#manageRequestsLink').addClass('notification');	
		            	$('#notificationSound').trigger('play');
		            	$('#alertImg').show();
		            	alertTrigger = 1;
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
	//check for notifications when loading the page
	checkForNotificationsOnLoad();	
	//if there are no prio notifications, start polling
	if(alertTrigger==0)
	{
		pollForNotifications();
	}
});