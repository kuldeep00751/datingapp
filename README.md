**Instructions**

1. clone repository:
`git clone https://github.com/it14019/dating-app.git`
2. change directory to 'dating-app':
`cd dating-app`
3. install composer dependencies: 
`composer install`
4. install NPM dependencies: 
`npm install`
5. create a copy of your .env file:
`cp .env.example .env`
6. generate an app encryption key:
`php artisan key:generate`
7. log in with your mysql user and create an empty database with your desired database name
8. connect the database:
new->Data Source->mysql. Fill `user`, `password`, `database` fields. If asked, set `serverTimezone` value to `UTC`.
9. edit .env file information:
`APP_NAME=Matches
APP_URL=http://localhost:8000
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_FROM_ADDRESS=test@test.com`
at the end of .env file add:
`FILESYSTEM_DRIVER=public`

10. migrate the database:
`php artisan migrate`
11. create a symbolic link:
`php artisan storage:link`
12. run the project (make sure the port is 8000):
`php artisan serve` 
13. To generate fake users, run` php artisan db:seed`. By default, 20 fake users will ge generated and added to 
database. You can change number of users generated in `AppSeed.php file`. Just change value `20` to your desired amount.
Also, by default Picture factory will make 1-10 random pictures for generated users. You can change this amount by 
changing value `rand(1, 10)` to your desired.

Have fun!

**Description**

A simple Laravel application, with following functionality:
- Register, Login, Password Reset;
- Configurable settings, e.g., age range, interested gender;
- Multiple picture upload;
- Like/Dislike system;
- Match History;
- Mail functionality;

When application is started, the view `welcome.blade.php` is returned. There are two options - Login or Register.

![Alt text](home-page.png?raw=true "Home page picture")

Let's register a new user. 

![Alt text](registration.png?raw=true "Registration picture")

You can see multiple fields for registration form. All fields are required. Only 18+ users can register for the site. 
Otherwise `Birthday` field will show an error message.

If registration was successful, user is redirected to `GET` route `/profile`, which uses `EditUserProfileController`.
Controller returns view `profile.blade.php`. Also, a welcome email is sent to registered user email.

![Alt text](edit-profile.png?raw=true "Edit profile picture")

As we can see, there are multiple optional fields and options, e.g., user can choose their location from drop-down list
(at this point, there are only 11 cities from Latvia); user can choose in which gender he/she is interested in and only 
selected gender will be shown for user. If selected both, obviously both genders will be shown. By default it's both; 
user can choose in what age range he/she is searching for the other half; user can upload picture (by default and if not 
uploaded, this default orange picture will be shown); user can add description 200 characters long.

![Alt text](update-profile.png?raw=true "Update profile picture")

When clicked on 'submit' button, page is redirected to `PUT` route `/profile`, which uses `UpdateUserProfileController`.
Controller checks if picture has been uploaded. If yes, it will be stored in `storage` symlink (if picture will be 
uploaded again, previous picture from `storage` will be deleted and the new one will be added).
Also, user information like `name`, `location`, `description` and others are updated in table `users`.
Page is redirected back to previous (`GET` route `/profile`) with message, that profile has been updated.

To make sure, that Harry will see some users that matches his requirements in section "Find a Date!" (from menu), 
generate some fake users (if not already done, go back to point 13.).

![Alt text](show-all.png?raw=true "Show all users picture")

So, when clicked on section "Find a Date!" user is redirected to `GET` route `/show-all` which uses `ShowAllUsersController`.
Controller checks in which gender is interested user and then use some scopes from `User` Model. E.g, Harry is interested
in females, so he will see all users in random order, from which isn't shown himself (`scopeWithoutMe`), isn't shown his 
already liked or disliked profiles (`scopeWithoutLiked`, `scopeWithoutDisliked`), are shown only female gender (`scopeOnlyFemale`) 
with his desired age range (`scopeAgeRange`). View `show-all.blade.php` is returned.

User can click on user, in which he/she is interested in and see more information about this user.
When clicked on user, page is redirected to `GET` route `/show-all/{user}/view`, which uses `ShowUserInfoController`.
Controller returns view `view.blade.php`.

![Alt text](view-user.png?raw=true "Wiew user picture")

When clicked on 'View Pictures', you can view this user's gallery.

![Alt text](view-pictures.png?raw=true "View user gallery picture")

When clicked on 'View Pictures', user is redirected to `GET` route `/users/{user}/pictures`, which uses `ShowUserPictures` 
Controller. It returns view `pictures.blade.php`.

When user views it's 'maybe-to-be-other-half' profile, user can choose does he/she like user, which is shown or doesn't
by clicking buttons 'YASS' or 'NOPE'.

When clicked on either one or other button, user is redirected to `PUT` route `/show-all/{user}/view`, which uses 
`LikeUserController`. Controller checks which button was clicked. E.g., if clicked button's 'key' was `liked-user-id`, 
then in table `user_likes` are saved authorized user id, liked user id and affection type - in this case 'like'.
Also, Controller makes sure that the next viewed person meets user requirements using scopes (like in `ShowAllUsersController`).
After button is clicked, page is redirected to `GET` route `/show-all/{user}/view` with other user id, which passes 
requirements.
When no more users meet requirements, a message is shown to please be patient.

When clicked on section "Matches" from menu, user can see which profiles he/she liked and disliked. 
Section "Matches" uses `ViewLikesController` with `GET` route `/likes`.
Controller finds users from database which user liked, disliked and with who he/she have a match (both users liked each other).
Emails are sent to both sides, when there is a match.
Controller returns view `view-likes.blade.php`.

![Alt text](likes-dislikes.png?raw=true "Liked and disliked users picture")

Also, if there is a match, it is shown.

![Alt text](match.png?raw=true "Match picture")

At this point, chat functionality is not implemented.

When clicked on section "View My Gallery" from menu, `GET` route `/my-pictures` is opened, which uses `ShowAuthorizedUserPicture`
Controller. Controller finds user pictures and show them, if there are any, in view  `my-pictures.blade.php`.

![Alt text](my-pictures.png?raw=true "My gallery picture")

When pictures, which user wants to add are chosen, button 'Add' needs to be clicked. When clicked, page is redirected to 
`POST` route `/my-pictures`, which uses `UploadUserPicture` Controller. It checks if there are any pictures uploaded and 
if are, they all are saved to `pictures` table and stored in `storage` symlink. Then redirects to `GET` page with
message, that pictures has been uploaded.

![Alt text](picture-upload.png?raw=true "Uploaded pictures picture")
