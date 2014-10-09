<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Login/Registration</title>
        <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    </head>
    <body>
        <div id="container">
            <h1>Welcome!</h1>
            <div id="forms">
                <div id="registration">
                    <h2>Register</h2>
                    <form action="/controller/register" method="post">
                        <table>
                            <tr>
                                <td>Name: </td>
                                <td> <input type='text' name='name'></td>
                            <tr>
                            <tr> 
                                <td> Alias: </td>
                                <td> <input type='text' name='alias'></td>
                            </tr>
                            <tr>
                                <td> Email: </td>
                                <td> <input type='text' name='email'></td>
                            </tr>
                            <tr>
                                <td>Date of Birth: </td>
                                <td> <input type='text' name='birthdate' placeholder='MM/DD/YYYY'></td>
                            </tr>
                            <tr>
                                <td> Password: </td>
                                <td> <input type='password' name='password'></td>
                            </tr>
                            <tr>
                                <td> Confirm Password: </td>
                                <td> <input type='password' name='confirm_password'></td>
                            </tr>
                            <tr>
                                <td> <input type='submit' value='Register'> </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div id="login">
                    <h2>Login</h2>
                    <form action="/controller/login" method="post">
                        <table>
                            <tr>
                                <td> Email: </td>
                                <td> <input type='text' name='email'></td>
                            </tr>
                            <tr>
                                <td>Password: </td>
                                <td> <input type='password' name='password'></td>
                            </tr>
                            <tr>
                                <td><input type='submit' value='Login'></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        <div id="messages">
            <text><br></text>
            <?php 
                if($this->session->flashdata('errors'))
                {
                    echo $this->session->flashdata('errors');
                }
             ?>
        </div>
    </body>
</html>