# dnbTable
a simple wamp table for updating the duty shedule of the doctors


dnb work flow 
===============



edit.php
----------

PHP Section:

It includes a PHP script that interacts with the database. This script is responsible for handling database operations like saving, updating, and deleting data.
It defines a class named API that extends the DBConnection class. This class contains methods for saving and deleting member data.
The get_client_info() method retrieves client information, including the IP address and hostname.
The save_member() method is called when saving member data. It constructs SQL queries to insert or update data in the members table.
The delete_member() method is called when deleting member data. It constructs an SQL query to delete data from the members table.
It checks the action parameter in the URL to determine which operation to perform (save or delete).
Based on the action parameter, it executes the corresponding method and returns a JSON response indicating the status of the operation.
HTML Section:

It consists of HTML markup to create the user interface.
It includes Bootstrap CSS for styling.
The page header contains the hospital name.
The main content area displays a title, a form for managing the duty schedule list, and a button to add new doctors.
Inside the form, there is a table (form-tbl) to display the duty schedule list. Each row represents a member with editable fields for duty area, name, contact, and shift/remarks. It also displays columns for user and last update.
The table also includes action buttons for editing and deleting members.
At the bottom, there is a button to add a new doctor.
JavaScript files (jquery-3.6.0.js, bootstrap.js, and script.js) are included for client-side functionality.
JavaScript Section:

The JavaScript code handles client-side interactions such as adding new rows, editing data, deleting rows, and form submission.
It includes functions to manage editing, deleting, and cancelling actions on table rows.
The script handles form submission via AJAX requests to perform save and delete operations.
Overall, this code creates a web interface for managing a duty schedule list, with backend functionality handled by PHP and client-side interactions managed by JavaScript.


api.php
---------

Class API extends DBConnection: This line defines a PHP class named API that extends the DBConnection class. This suggests that DBConnection is a parent class from which API inherits properties and methods.

Constructor and Destructor: The constructor __construct() and destructor __destruct() are special methods in PHP classes. The constructor is called when an object of the class is created, and the destructor is called when the object is destroyed. In this case, they are used to initialize and clean up the database connection.

get_client_info(): This is a private method defined within the API class. It retrieves the client information, including the IP address and hostname. It uses $_SERVER['REMOTE_ADDR'] to get the IP address of the client and gethostbyaddr() to get the hostname associated with the IP address.

save_member(): This method is responsible for saving or updating a member record in the database. It retrieves the data sent via POST request (excluding the ID) and constructs an SQL query to either insert a new record or update an existing one. It also captures the client information using get_client_info() and includes it in the SQL query.

delete_member(): This method handles the deletion of a member record from the database. It takes the ID of the record to be deleted from the POST request and constructs a SQL query to delete the corresponding record.

Switch Statement: This switch statement checks the value of the action parameter passed via the GET request. Depending on the value of action, it calls the appropriate method (save_member() or delete_member()) of the API object and echoes the result.

JSON Response: The methods save_member() and delete_member() return a JSON-encoded response indicating the status of the operation (success or failure) along with a message and any error information if applicable.


script.js
----------

Document Ready Function:

$(function() { ... });: This function ensures that the code inside it will run once the DOM (Document Object Model) is fully loaded and ready.
Add New Row Functionality:

When the #add_member button is clicked, this function adds a new row to the table.
It checks if there is already an empty row present, and if so, it sets the focus to the first editable field ([name="duty"]).
The new row contains editable fields for duty area, name, contact, and shift/remarks, as well as non-editable columns for user (defaulted to "UserName") and last update (defaulted to "Now").
Edit Row Functionality:

When an "Edit" button with the class .edit_data is clicked, this function allows the user to edit the corresponding row.
It enables content editing for all cells in the row except for the last two columns (user and last update).
The function also hides non-editable elements and shows editable elements for better user experience.
Delete Row Functionality:

When a "Delete" button with the class .delete_data is clicked, this function prompts the user to confirm the deletion.
If confirmed, it sends an AJAX request to the server to delete the corresponding row.
Upon successful deletion, it displays an alert and reloads the page to reflect the updated data.
Form Submission Handling:

When the form with id #form-data is submitted, this function prevents the default form submission behavior.
It gathers the data from the editable fields in the table rows and validates it.
If all fields are filled and validation passes, it sends an AJAX request to the server to save the data.
Upon successful save, it displays an alert and reloads the page to reflect the updated data.
Validation Functions:

IsEmail(name): Validates the name using a regular expression pattern.
isContact(contact): Validates the contact number by checking if it's numeric and has a length of 4 digits.
Cancel Button Functionality:

When a "Cancel" button is clicked, this function either removes the row if it's a newly added row (no data-id attribute), or it reverts the changes made to the row by hiding editable elements and showing non-editable elements.
Overall, this JavaScript code provides interactivity to the duty schedule list web page, allowing users to add, edit, and delete rows dynamically while ensuring data validation and integrity.
