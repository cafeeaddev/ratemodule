# Rate block for Moodle 

The Rating with Stars block was created so that the student can rate activities in Moodle from one to five stars.

In this version, he will not be able to change his opinion and the data is being recorded in the mdl_block_ratemodule database table, where we record the following data:

rating - number of stars chosen
coursemoduleid - id of the course module in which the block was inserted
userid - id of the user who is evaluating
timecreated - evaluation date

Attention: In this version of the block we do not have an administrative area of reports, it will be available in the next version.

## Contributions

Originally written by Café EAD

## Installation

1- Download the zip file into this repository

2- In Moodle logged in as an administrator click on Site Administration > Plugins > Install Plugins and upload the zip file.

3- Follow Plugin Installation Steps.

## Adding the Block to the Course

1 - Create a course in Moodle
2 - Enter the course you want to use the block
3 - Activate editing
4 - Click on add a block
5 - Choose the Ratemodule block


## Configuring the block to appear only within activities

1 - Check if editing is active in the course
2 - In the block click on the gear
3 - Click Configure Ratemodule
4 - Change the display in page types to any page in the course
5 - In the topic On This Page, change the option Visible to no
6- Click on save changes

## Testing in an example page activity

1 - Activate course editing
2 - Click on Add an activity or resource
3 - School Activity Page
4 - Put the mandatory fields of your choice
5 - After configuring click on save and return to the course
6 - Enter the activity created and add the Ratemodule

This block was created so that the student does not change his choice and the data is recorded in the mdl_block_ratemodule database table to be used in a future version as reports for the administrator.

## Upgrading

Before upgrading it is advisable that you test the upgrade first on a COPY of your production site, to make sure it works as you expect.

### Backup important data ###
There are three areas that should be backed up before any upgrade:

* Moodle dataroot (For example, server/moodledata)
* Moodle database (For example, your Postgres or MySQL database dump)


#### block 1.0 ####
You can only upgrade from Moodle 3.9 or later.
