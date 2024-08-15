 <?php 

   // connect to the database
    $conn = mysqli_connect('localhost','kevin','test123','void_pizza');

    if(!$conn){
        echo 'errow while connection'.mysqli_connect_error();
    } 

  ?>