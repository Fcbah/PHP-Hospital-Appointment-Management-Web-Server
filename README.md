# PHP TASK 2 - Build Authentication System

## Project Information
This is a project that implements an Registration, Authentication and Login system with 3 different Access level. Logging date and time of server visit on the server... in partial fulfilment of promotion requirement for stage 2 start.ng internship program 2020 

## Installation and Server Setup
+ You can just clone this repository into any **empty folder** ( or create a new folder) in your servers `htdocs` directory (The default direcotry for http://localhost/) of your Server. Or if you wish you can use any directory you want by seting up an **alias** in your servers configuration file to the directory.

+ Then you can start your server. If you are using XAMPP on Ubuntu, it is as simple as running `sudo /opt/lampp/lampp start` on your terminal, while if you are using Windows you can just run the GUI App for your server.

+ Depending on how you setup the project in your `htdocs` folder or in your _alias_ directory you can enter the url in your browser. E.g. if you cloned the repository into a folder named `Authentication` in your `htdocs` folder. the address to the home page will be [http://localhost/Authentication](http://localhost/Authentication/)

## Possible ERRORS to Avoid
Ensure that if your are using either Ubuntu or Mac OS, PHP has  **a write permission** to the Project Directory

In case of Ubuntu using XAMPP you can easily solve permission issues by changing the folder owner

```sudo chown "daemon:daemon" -R <PATH TO FOLDER>```

OR if you are not worried about the security implication

```sudo chmod 777 -R <PATH TO FOLDER>```