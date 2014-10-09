<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Quotable Quotes</title>
        <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    </head>

    <body>
        <div id='container' style='width: 425px'>

            <div class="box">
                <h1>Welcome, <?php echo $alias ?>! </h1>
            </div>

            <div class="box">
                <a class="box" href="/controller/logout">Logout</a>
            </div>

            <div class="box">
                <h3> Contribute a Quote</h3>
                <div class="box">
                    <form action="/controller/new_quote" method="post">
                        <table>
                            <tbody>
                                <tr>
                                    <td> Author: </td>
                                    <td> <textarea name='author' rows="1" cols="46"></textarea> </td>
                                </tr>
                                <tr>
                                    <td> Quote: </td>
                                    <td> <textarea name='quote' rows="5" cols="46"></textarea> </td>
                                </tr>
                            </tbody>
                        </table>
                        <input type='hidden' name='posted_by' value='<?php echo $alias ?>'>
                        <input type='submit' value='Submit'>
                    </form>
                </div>

            </div>

            <div class="box">
                <h3> Your Favorites</h3>
                <!-- <div class="box" style='height:275px; overflow:scroll;'> -->
                <div class="box">
                    <?php
                        foreach ($favorities as $quote)
                        {
                            echo "<div class='box'>";
                            echo "<textarea name='quote' rows='5' cols='52'>{$quote['author']}: {$quote['quote']}</textarea> <br>";
                            echo "<text> Posted by: {$quote['posted_by']} </text> <br>";
                            echo "<a style='border-style:groove;' href='/controller/remove_from_favorites?user_id={$user_id}&quote_id={$quote['quote_id']}'>Remove From My List</a> </td>";
                            echo "</div>";
                        }
                    ?>
                </div>
            </div>

            <div class="box">
                <h3> Quotable Quotes</h3>
                <!-- <div class="box" style='height:275px; overflow:scroll;'> -->
                <div class="box">
                    <?php
                        foreach ($quotables as $quote)
                        {
                            echo "<div class='box'>";
                            echo "<textarea name='quote' rows='5' cols='52'>{$quote['author']}: {$quote['quote']}</textarea> <br>";
                            echo "<text> Posted by: {$quote['posted_by']} </text> <br>";
                            echo "<a style='border-style:groove;' href='/controller/add_to_favorites?user_id={$user_id}&quote_id={$quote['quote_id']}'>Add to My List</a> </td>";
                            echo "</div>";
                        }
                    ?>
                </div>
            </div>




        </div>
    </body>

</html>