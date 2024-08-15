<?php 

   include('config/db_connect.php');
   $errors = array('email' => '' , 'title' => '', 'ingredients' => '');
   $email = $title = $ingredients = '';


   if (isset($_POST['submit'])) {

      //CHECK MAIL
      if(empty($_POST['email'])) {
         $errors['email'] = "An email is required <br />";
      }else{
         $email = $_POST['email'];
         if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "email must have validate address";
         }
      }

      //title
      if (empty($_POST['title'])) {
         $errors['title'] =  "An title is required <br />";
      }else{
         $title = $_POST['title'];
         if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
            $errors['title'] =  'title must be letters and spaces only';
         }
      }

      //ingredients
      if (empty($_POST['ingredients'])) {
         $errors['ingredients'] = 'ingredients are required <br />';
      } else {
         $ingredients = $_POST['ingredients'];
         if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) {
           $errors['ingredients'] =  'Ingredients must be comma seperated';
         }
      }

      if (array_filter($errors)) {
         // echo 'echo errors in the form'
      } else {

         $email = mysqli_real_escape_string($conn,$_POST['email']);
         $title = mysqli_real_escape_string($conn,$_POST['title']);
         $ingredients = mysqli_real_escape_string($conn,$_POST['ingredients']);

         // create sql
         $sql = "INSERT INTO pizzas(email,title,ingredients) VALUES ('$email','$title','$ingredients')";

         //save to db and check
         if (mysqli_query($conn, $sql)) {
            // success
            header('location:index.php');
         } else {
            //error
            echo 'query error' . mysqli_error($conn);
         }
         
      }


   }


 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	
    <?php   include('template/header.php') ?>

    <section class="container grey-text">
       <h4 class="center">Add a pizza</h4>
       <form class="white" action="add.php" method="POST">
          <label>Your Email</label>
          <input type="text" name="email" value="<?php echo $email ?>">
          <div class="red-text"><?php  echo $errors['email']; ?></div>
          <label>Pizza Title:</label>
          <input type="text" name="title" value="<?php echo $title ?>">
          <div class="red-text"><?php  echo $errors['title']; ?></div>
          <label>Ingredients (comma separated):</label>
          <input type="text" name="ingredients" value="<?php echo $ingredients ?>">
          <div class="red-text"><?php  echo $errors['ingredients']; ?></div>
          <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
       </form>
    </section>
    <?php   include('template/footer.php') ?>

 </html>