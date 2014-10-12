//global variables
var alertTrigger = 0;
var startPolling = 1;
//ajax url
var ajaxNotificationsUrl = "http://localhost/mysymptomsbook/index.php?r=doctorRequests/getNotifications";
//placeholder data
var data = 'something';
//alert sound function
function playNotificationSound()
{
	$('#notificationSound').trigger('play');
}
//check if polling should continue
function continuePolling(alertTriggerValue)
{
	if(alertTriggerValue!=3)
	{
		pollForNotifications();
	}
}
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
					switch(dataReturn)
					{
						case '3':
							$('#manageRequestsLink').addClass('notification');
							$('#managePatientSymptomsLink').addClass('notification');
							startPolling = 0;		
		            		break;
		            	case '2':	
							$('#managePatientSymptomsLink').addClass('notification');
							alertTrigger = 2;		
		            		break;
						case '1':	
							$('#manageRequestsLink').addClass('notification');
							alertTrigger = 1;	  	
		            		break;
		            	default:
		            		break;
		            }
		            //if there are no prior notifications, start polling
					if(startPolling==1)
					{
						pollForNotifications();
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
					switch(dataReturn)
					{
						case '3':	
							$('#manageRequestsLink').addClass('notification');
							$('#managePatientSymptomsLink').addClass('notification');
							//play notification sound
							if(alertTrigger!=3)
							{
								playNotificationSound();
								alertTrigger=3;
							}		
		            		break;
		            	case '2':
							$('#managePatientSymptomsLink').addClass('notification');
							if(alertTrigger!=2)
							{
								playNotificationSound();
								alertTrigger=2;
							}	
		            		break;
						case '1':	
							$('#manageRequestsLink').addClass('notification');
							if(alertTrigger!=1)
							{
								playNotificationSound();
								alertTrigger=1;
							}	  	
		            		break;
		            	default:
		            		break;
		            }
		        },
		   		error: function() {
		            alert("Error occured.please try again");
		    	},
		    	dataType: 'html',
		    	complete: continuePolling(alertTrigger)
  		});
  	}, 5000);
};
//function that will start the polling process
$(document).ready(function(){
	//check for notifications when loading the page
	checkForNotificationsOnLoad();	
});
