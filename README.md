# SDP-GA-
Software Development Project.
Hi, we are Group A, building a project named Witchcraft.code which teaches university students to learn the programming language Python. The user will go through different game episodes that relate to various topics and Python's key functions. At the start of each level, a tutorial video will guide users to navigate through the episode and learn about the specific. Users can look at hints throughout the game if the questions are too hard. Upon finishing the game, users could get a certificate of completion and give their feedback to Witchcraft.code. The user's feedback will be visible in the admin panel. The admin can reset leaderboard, edit and delete episode questions, view feedback, view and edit certificate names, and update the user's information. 

https://kteceline.github.io/SDP-GA-/


18.3 Installation Guide
1.	Download XAMPP
Figure 18.3.1 Choice the XAMPP version
Firstly, users need to download the XAMPP from the official XAMPP website (https://www.apachefriends.org/download.html). Choose the version that corresponds to the operating system, whether it is Windows or macOS. 

Figure 18.3.2 Download XAMPP
Then, click the download link and wait for the installer to finish downloading.


2.	Run XAMPP
Figure 18.3.3 XAMPP Control Panel
After installing XAMPP, open the XAMPP Control Panel and start the Apache and MySQL services by clicking the “Start” button next to each service.

Figure 18.3.4 Localhost phpMyAdmin
Then, open a web browser and go to http://localhost/phpmyadmin. In phpMyAdmin, create a new database by clicking the “New” button on the left panel. 


3.	Create an SQL table
Figure 18.3.5 Create the SQL database
Before creating the table, users need to create a database named “sdp_ga”.

Figure 18.3.6 SQL file provided in sources code folder
To create a table, users can copy the create table command provided in the sql file to define the table structure. 

Figure 18.3.7 SQL command for create user_information table 
For example, click on the “SQL” tab and enter an SQL command to create the user_information table.
4.	Run localhost
Figure 18.3.8 Localhost page
Open Google Chrome or users preferred web browser. In the address bar, type http://localhost  and press “Enter”. This will bring up to the default XAMPP welcome page, which confirms that the local server is functioning correctly.

5.	Open localhost link to access the system
To view the system, place the source codes files in the “htdocs” directory within the XAMPP installation directory (e.g., C:\xampp\htdocs). Users can then access the website by navigating to http://localhost/your-folder-name in Chrome, which replaces the folder name with the actual name of the folder where the website files are stored. 

Figure 18.3.9 Main system page
For example, http://localhost/SDP-GA-/. 

6.	Follow the user manual
Users can refer to the user manual provided in Section 13.0 of the report for specific instructions and additional details. The manual offers guidance on how to use the system’s features and functionalities effectively.

7.	GitHub
 Figure 18.3.10 Github
To view the system or code, users can also open the GitHub repository link provided (https://github.com/KTECeline/SDP-GA-.git). This link will take users to the project’s repository on GitHub, where can explore the source code.


