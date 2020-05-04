### Book Appointment
+ Check first of all if the Department where you want to book appointment has been registered under the appointment database
    + If Departments exist. You check if the user has already registered an unhandled appointment with the department before now.
    + If A registered Appointment exist, you retain the same appointment name, then edit the transaction details.
### Pay for transaction
+ You first select from the list of unpaid appointments the appointment you want to pay for. 

### Transaction
+ A transaction occurs when payment for an appointment turns out successful
+ A transaction will be designed as payment for a single appointment.
+ Identified in the database by the user's email.
+ Each entry is presented as an Transaction_ID - Department - appointment_file_name - FullName
+ The Appointment must be updated with its corresponding transaction-ID when payed

### Handling - FUTURE
+ When a transaction has been handled it is renamed with its transaction-ID and email. And Moved to another folder ___. So the way to access it is to first check the list of transactions by a user.

### SUPER_ADMIN - LIST
+ To allow the super_admin to check for the list every transaction will be recorded in a `master` document in the `transactions` folder. Super Admin's Seen transactions will be stored in a `all_master` so the admin can refresh the list of transactions.
+ 