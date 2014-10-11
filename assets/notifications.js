//global variables
var alertTrigger = 0;
var startPolling = 1;
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
					switch(dataReturn)
					{
						case '3':
							$('#manageRequestsLink').addClass('notification');
							$('#managePatientSymptomsLink').addClass('notification');
							startPolling = 0;		
		            		break;
		            	case '2':	
							$('#managePatientSymptomsLink').addClass('notification');	
		            		break;
						case '1':	
							$('#manageRequestsLink').addClass('notification');	  	
		            		break;
		            	default:
		            		break;
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
		            		break;
		            	case '2':
							$('#managePatientSymptomsLink').addClass('notification');	
		            		break;
						case '1':	
							$('#manageRequestsLink').addClass('notification');	  	
		            		break;
		            	default:
		            		break;
		            }
		            playNotificationSound();
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
	if(0==1)
	{
		pollForNotifications();
	}
});

//alert sound function
function playNotificationSound()
{
	$('#notificationSound').trigger('play');
}