<?php
/**
 *demonstration exercise14.php
 *Insert and Select data from MySQL using MySQLi
 */
?>
<!DOCTYPE html>
<html>

<head>
  <title>Question</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <h1 class="blueText">Sign Up Form</h1>
    <hr>
    <!--Form-->
    <form id="form1" method="post" action="main.php">
      <table>
      <tr>
          <th><label for=input1>Enter your UserName</label></th>
          <td><input id=input1 type="text" name="fname" required="required"></td>
        </tr>
        <tr>
          <th><label for=input2>Enter your First Name</label></th>
          <td><input id=input2 type="text" name="fname" required="required"></td>
        </tr>
        <tr>
          <th><label for=input3>Enter your Last Name</label></th>
          <td><input id=input3 type="text" name="lname" required="required"></td>
        </tr>
        <tr>
          <th><label for=input4>Enter your password</label></th>
          <td><input id=input4 type="password" name="password" required="required"></td>
        </tr>
        <tr>
          <th><label for=input5>Confirm your password</label></th>
          <td><input id=input5 type="password" name="confirmPassword" required="required"></td>
        </tr>
        <tr class="submit">
          <td></td>
          <td><input id="submit1" type="submit" name="create" value="Create new User" /></td>
        </tr>
        <tr class="submit">
          <td></td>
          <td><input id="submit2" type="submit" name="signIn" value="Sign-In" /></td>
        </tr>
      </table>
    </form>
  </div>
</body>

</html>