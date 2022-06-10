# Technology Stack

The technology stack is as follows:
- HTML As a markdown tool on the front-end.
- CSS as styling and animations tool
- Bootstrap As a styling library
- Jquery and Vanilla javascript for data manipulation and user interaction.
- - Javascript is used to add the general behavior of the application, connection to backend API and enhancement of user interface and interaction.
- On the backend side / database: Mysql
- - relational model for the general management app for questions, answers,  scores, score management, parametrization, and users management.
- API on database backend to be used by web application
- - REST API built with HTTP protocol standards using common verbs: GET, PUT, POST, DELETE

# Security
- We used JWT standard which provide a safe method to transfer tokens which guarantee a well managed and secure session for users which access both ends of the application. 
- API methods are protected using the user active session´s token and respond to user levels and priviledges. 


# Hosting
- The application is currently served by Firebase:
- - Firebase is a Serverless service offered by Google which allows us to serve web static files in a matter of minues.
- - Firebase offers a fairly extensive free plan on top of very efficient servers whicih provide:
- - - SSL certificates
- - - optimized CDNs
- - - Ease of deployment in multiple stages / versions.

We are using this environment for development, later we can decide where to deploy on self hosted servers or cloud linux instances. Being a common and lightweight architecture it could run on any common server.

## Hosting options
-  Since this application is build with a common and lightweight stack of technology it could be served by most common servers such as:
-  Apache, Tomcat, NGINX 
-  Windows or Linux
-  Serverless: Firebase, Netlify, AWS S3, Heroku, etc...



# Code Management
- The whole codebase is managed by git version control using a private GitHub repository that you can access here: (you need access before) 
- - https://github.com/ucguate/IDB_EcoMicro_BZ/edit/master/README.md
- We used master branch as the main and only branch no this repo.
- - You can check the commits version history to see the progress of the application from beginning to end. 

## Folder Structure:
```
project
└───assets #folder to store image assets * not relevant as used images are inside exports folder.
└───database #folder to store image assets * not relevant as used images are inside exports folder.
│   │   script.sql # dump sql file to restore the whole database structure and required data. 
└───exports #folder where all static files that make up the web application are stored.
│   └───assets #static assets including: bootstrap library, fonts, css and js files. 
│   │   └───bootstrap #bootstrap
│   │   └───fonts #fonts
│   │   └───img #images
│   │   └───js #js files used for templating, animations and styles.
│   └───exports #
│       └─── assets #packed static assets ready for publication.
│       │       └─── js #js files used to generate forms and determine risk reports.
│       └─── bzmaps #html and js files that make up the mapping framework for determining risk values and address location.
│       │   |   *.tif  alto includes .tif files used to generate risk analysis maps. 
│       │   home.html
│       │   viewAssessment.html
│       │   index.html
│       │   login.html
│       │   climateScenarios.html
│       │   riskMaps.html
│       │   videoTutorials.html
│       │   about.html
│       │   assessmentReport.html
│       │   directions.html
│   firebase.json # json file which includes the basic configuration to deploy into firebase hosting. 
│   README.md 
│
```
# Improvements derived from the workshop 
- Security enhancements:
- - User level and user Level permissions: Each user level has table specific permissions that can be customized from the administrator side. This allows administrators to assign permissions to users and protect data from being editted / deleted by non administrative users. 
- - Administrator: this user level has administrative control over the platform. Being able to add, edit, delete, and view every record on all tables. 
- - Consultant: This user can create assessments on the Risk Assessment tool but does not have administrator access to tables such as: deleting and editing records. Consultants cannot see other user's profile nor manage user's permissions. 
- Audit Log
- - Audit log functionality was added in order to allow administrative users to control what other users do on the platform. This audit log allows to record the following details:
- - - datetime: Date and time of the event's log
- - - script: script/method thar executed the action
- - - user: User that executed the action. 
- - - action: Executed Action: EDIT, ADD, DELETE
- - - table: User that executed the action.  
- - - field: column / field changed
- - - old_value: original value
- - - new_value: new value. 

# Instalation procedure
  1. Clone this repo
  2. After cloning repo move the contents of folder: "exports/exports/*" to your public folder example (inside exports/exports... ): cp -r * /
  3. Run the sql (form_maker_09_02_2020.sql) file located inside "exports/exports/mysql" 
    1. connect to mysql: mysql -u user -p
    2. create database: CREATE DATABASE tarp_db;
    3. exit database: exit;
    3. run sql file (make sure to select file under exports/exports/) : mysql --user="ecom" --database="tarp_db" -p < "form_maker_09_02_2020.sql"
    4. enter mysql password
    5. verify tables where created.
  4. Modify admin panel and api files database connection settings:
    1. modify file "admin/ewcfg.php": 
      1. search for: CONNECTION_INFO and change: db user, password and db name
      2. search for: PRODUCTION_CONNECTION_INFO and change: db user, password and db name
    2. change database conection on report builder:
      1. modify both files: "admin/_tools/_report.php" and "admin/_tools/_ins.php"
        change database: user, password, and name. 
  5. grant permissions on: "/admin/_tools/posts"
      1. chmod 777 posts/
  6. install PHP XML parser
  7. sudo apt-get install php7.4-xml
  8. sudo service apache2 restart

