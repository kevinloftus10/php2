This is the "Read Me"

Final Project

Task:
Create a conference room scheduler PHP web application.

IMPORTANT: This must by your own code. There are many code samples available on the web. DO NOT use code from the web.

Requirements:


Conference Rooms:
The application should allow a user to maintain a list of conference rooms. - in progress (add page done/tested)
Create a new table in your database to store a list of conference rooms.  - done
Create the web pages necessary to list, add and delete conference rooms. - (add done/tested)
Only allow reservations during dates and times that are not already reserved. Conference rooms cannot be double booked. - done testing rn
The list of conference room reservations should have two display options.
    All - display all conference room reservation schedules; past and future. - done (just display them)
    Future - display conference room reservations that are scheduled in the future only. - done (just display them)

Reservations:
The application should allow a user to reserve a conference room for a specified date and time range.
The application should allow a user to select a conference room from the list of conference rooms and specify the date and time range for their reservation.
The specified date and time range for the reservation should include the start and end date and times.
Only allow reservations on the same day. Reservations cannot span days.
Only allow reservations during the business hours of 8:00am to 5:00pm on weekdays.
Do not allow reservations outside of business hours or during the weekends.
Verify that all user input is correct.
Display error messages where appropriate.
Create a new table in your database to store the conference room reservation schedules.
Create the web pages necessary to list, add and delete conference room reservations.
The list of conference room reservations should be sorted in date and start time order.

Complete Project:
Upload all of the files to your website under midterm
Create a midterm link to the conference room scheduler on your website
Test on your website to confirm that everything is working properly
Use the Export feature in phpMyAdmin to save a CREATE TABLE script for all tables used in this project
Zip your files and submit in the dropbox, including the CREATE TABLE scripts