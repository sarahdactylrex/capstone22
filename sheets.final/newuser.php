<?php
require_once 'include/header.php';
?>

<form action="newuser-submit.php" method="post" style="margin: 30px 0">
    <fieldset>
    <legend>Create new user account</legend>
    <div>
        <label for="username">Desired Username:</label>
        <input type="text" name="username" id="username">
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
    </div>
    <div>
        <label for="confirm">Confirm Password:</label>
        <input type="password" name="confirm" id="confirm">
    </div>
    <div>
        <label for="firstname">First Name:</label>
        <input type="text" name="firstname" id="firstname">
    </div>
    <div>
        <label for="middlei">Middle Initial: (optional)</label>
        <input type="text" name="middlei" id="middlei">
    </div>
    <div>
        <label for="lastname">Last Name:</label>
        <input type="text" name="lastname" id="lastname">
    </div>
    <div>
        <label for="email">Email Address:</label>
        <input type="text" name="email" id="email">
    </div>
    <div>
        <label for="phone">Phone Number: (optional)</label>
        <input type="text" name="phone" id="phone">
    </div>
    <div>
        <button type="submit">Create Account</button>
        <button type="reset">Clear<br>Form</button>
    </div>
    </fieldset>
</form>

<?php require_once 'include/footer.php' ?>