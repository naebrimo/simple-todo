@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="jumbotron">
                <h2 class="display-4 text-center">My Todo List App</h2>
                @auth
                <div class="text-center">
                    <a class="btn btn-primary" href="{{ route('todo.index') }}">Go to Todo List</a>
                </div>
                @endauth
            </div>
            <section>
                <h3>App roles and users</h3>
                <hr />
                <h4>Two types of roles : </h4>
                <ul>
                    <li><strong>Admins</strong> - create, update and delete <em>Users</em>. (only admin can create new user, user registration is disabled.)</li>
                    <li><strong>Users</strong> - create, update, and delete <em>Todos</em>. (the only todo they can update and delete is the one user made only.)</li>
                </ul>
                <br />
                <h4>List of initial users : </h4>
                <ul>
                    <li>
                        <strong>Admins</strong>
                        @guest('admin')
                            <a class="btn btn-link d-inline"href="{{ route('admin.login') }}">Login now.</a>
                        @endguest
                        <ul>
                            <li>Name: <em>Richard Roe</em></li>
                            <li>Email: <em>richardroe@example.com</em></li>
                            <li>Username: <em>root</em></li>
                            <li>Password: <em>password123</em></li>
                        </ul>
                    </li>
                    <li>
                        <strong>Users</strong>
                        @guest('user')
                            <a class="btn btn-link d-inline"href="{{ route('login') }}">Login now.</a>
                        @endguest
                        <ul>
                            <li>Name: <em>John Doe</em></li>
                            <li>Email: <em>johndoe@example.com</em></li>
                            <li>Username: <em>johndoe</em></li>
                            <li>Password: <em>password123</em></li>
                        </ul>
                        <br />
                        <ul>
                            <li>Name: <em>Jane Doe</em></li>
                            <li>Email: <em>janedoe@example.com</em></li>
                            <li>Username: <em>janedoe</em></li>
                            <li>Password: <em>password123</em></li>
                        </ul>
                    </li>
                </ul>
            <section>
            <section>
                <h3>Default Features</h3>
                <hr />
                <ul>
                    <li>
                        <strong>Validations:</strong>
                        <ul>
                            <li><strong>Date</strong> - Input date is required and must not be empty.</li>
                            <li><strong>Date</strong> - Input date must be greater than or equal to today/'s date.</li>
                            <li><strong>Title</strong> - Input title is required and must not be empty.</li>
                            <li><strong>Title</strong> - Input title should be less than 100 characters.</li>
                            <li><strong>Description</strong> - Input description is required and must not be empty.</li>
                            <li><strong>Description</strong> - Input description should be less than 100 characters.</li>
                        </ul>
                    </li>
                    <li>
                        <strong>Pages/Screen:</strong>
                        <ul>
                            <li><strong>Confimation Page</strong> - There should be a confirmation page upon submitting of new todo from input screen/page.</li>
                            <li><strong>Confimation Page</strong> - Upon pressing "back" in confirmation page, it should return to input screen/page with inputs.</li>
                            <li><strong>Confimation Page</strong> - Only after confirmation page the todo will be save on the database.</li>
                            <li><strong>Success Page</strong> - There should be a complete page upon submitting of new todo from confirm screen/page.</li>
                            <li><strong>Success Page</strong> - Upon pressing "To do list", it should return to the todo list.</li>
                        </ul>
                    </li>
                </ul>
            </section>
            <section>
                <h3>Additional Features</h3>
                <hr />
                <ul>
                    <li><strong>Todo Search:</strong> User can search from todo list upon input and submit on the searchbox.</li>
                    <li><strong>Todo Sort:</strong> User can sort todo list upon clicking collumn name in the table.</li>
                </ul>
            </section>
        </div>
    </div>
</div>
@endsection
