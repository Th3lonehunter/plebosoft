# Plebosoft
The Plebosoft project repository. 

## General Information
Keep the repository up-to-date with changes to ensure that we are always working with the current version.

If you have any issues with GitHub or need help, speak to Drew.

## Connecting CodeAnywhere with GitHub
* Create an account with [CodeAnywhere](https://codeanywhere.com/).
* Connect your CodeAnywhere account with your GitHub account.
* Create a new connection in CodeAnywhere, go to GitHub and the repository should show up.
* You now have access to all the GitHub files from CodeAnywhere.

## Ensure you pull the repository before making changes!!!
Always ensure you have the latest version of the repository, do this by the following:

* When you start a new session, open up the SSH Terminal and type:
```
git pull origin master
```
* Press enter and you are met with a terminal screen. At this, do the following:
  * press i and type the merge message
  * press escape
  * type ":wq"
  * press enter

This will keep your local files in CodeAnywhere up-to-date.

## Committing changes to GitHub
Open up the Plebosoft SSH Terminal in CodeAnywhere and write out the following lines to commit changes:
```
git add -A
```
```
git commit -am "message"
```
```
git push origin master
```
This will push the changes to GitHub. 
Please remember to put a meaningful message where "message" is so that we can keep track of the changes made.