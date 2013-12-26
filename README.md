MAG-NotifyCustomer
==================

Introduction 
-------------------------------------------------------------
MAG-NotifyCustomer Customer notification Extension for Magento


MAG-NotifyCustomer is a Customer notification extension. Admin can send a notification to a Customer and this notification will display under My-notifications in the Customer's My-Account page. We are still doing some modifications in this extension and will upload latest release soon with new version.

Note that while this extension is now considered stable, it is strongly recommended that it be tested on a development/staging site before deploying on a production site.


Features
-------------------------------------------------------------

 1) Admin can show the list of all Users in the Send-Notification page.
 2) Admin can send a notification to multiple users at the same time.
 3) Users will see notifications listed under their My Notifications tab.
 

Requirements
-------------------------------------------------------------
 
  Magento Community Edition 1.8+
  

Manual Installation
-------------------------------------------------------------

   1)Download Magento extension
   2)Move into target directories   
   3)You will need to login to your admin account, clear Magento's cache, log out, and log back in again.   
   4)In the top menu you can see notification message.
   5)You can send notification to registered Customers and view notifications sent to users.
   
Handling Requests  
-------------------------------------------------------------

public function indexAction() 
    {
        // View all customers
    }
public function editAction()
    {
           // Edit notification messages
    }
 public function newAction()
    {
        // Create new notification while sending notification to customer.
    }
   
Support
-------------------------------------------------------------

If you have an issues, please send me an email at "ajaymishra@synsoftglobal.com" and if you still need help, open a bug report in GitHub's issue tracker.

Contributions
-------------------------------------------------------------

This extension is developed by Synsoft Global and his involvement is for further code development and design.


   
