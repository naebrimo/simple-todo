# My Simple Todo App
* * * * *

### App roles and users

* * * * *

#### Two types of roles :

-   Admins - create, update and delete *Users*. (only admin can create new user, user registration is disabled.)
-   Users - create, update, and delete *Todos*. (the only todo they can update and delete is the one user made only.)

#### List of initial users :

-   Admins [Login now.](http://127.0.0.1:8000/admin/login)
    -   Name: *Richard Roe*
    -   Email: *richardroe@example.com*
    -   Username: *root*
    -   Password: *password123*
-   Users [Login now.](http://127.0.0.1:8000/login)
    -   Name: *John Doe*
    -   Email: *johndoe@example.com*
    -   Username: *johndoe*
    -   Password: *password123*

    -   Name: *Jane Doe*
    -   Email: *janedoe@example.com*
    -   Username: *janedoe*
    -   Password: *password123*

### Default Features

* * * * *

-   Validations:
    -   Date - Input date is required and must not be empty.
    -   Date - Input date must be greater than or equal to today/'s date.
    -   Title - Input title is required and must not be empty.
    -   Title - Input title should be less than 100 characters.
    -   Description - Input description is required and must not be empty.
    -   Description - Input description should be less than 100 characters.
-   Pages/Screen:
    -   Confimation Page - There should be a confirmation page upon submitting of new todo from input screen/page.
    -   Confimation Page - Upon pressing "back" in confirmation page, it should return to input screen/page with inputs.
    -   Confimation Page - Only after confirmation page the todo will be save on the database.
    -   Success Page - There should be a complete page upon submitting of new todo from confirm screen/page.
    -   Success Page - Upon pressing "To do list", it should return to the todo list.

### Additional Features

* * * * *

-   Todo Search: User can search from todo list upon input and submit on the searchbox.
-   Todo Sort: User can sort todo list upon clicking collumn name in the table.
