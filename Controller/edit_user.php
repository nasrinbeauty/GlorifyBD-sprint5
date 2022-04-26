<?php

if (isset($_GET['id'])) {

  $edit_user_query = query("SELECT * FROM users WHERE user_id=". escape_string($_GET['id']));
  confirm($edit_user_query);


  while ($row = fetch_array($edit_user_query)) {

  $user_name    = escape_string($row['user_name']);
  $email        = escape_string($row['email']);
  $password     = escape_string($row['password']);
  $user_image   = escape_string($row['user_image']);

   $display_image = display_image($user_image);

  }

  update_admin_user();

}








 ?>




                        <h1 class="page-header">
                            Edit Information of
                            <small><?php echo $user_name; ?></small>
                        </h1>

                      <div class="col-md-6 user_image_box">

                    <a href="#" data-toggle="modal" data-target="#photo-library"><img class="img-responsive" src="" alt=""></a>

                      </div>


                    <form action="" method="post" enctype="multipart/form-data">




                        <div class="col-md-6">

                           <div class="form-group">

                            <input type="file" name="file" > <br>
                              <img width='200' src="../../resources/<?php echo $display_image; ?>" alt="">

                           </div>


                           <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control"  value="<?php echo $user_name; ?>" >

                           </div>


                            <!-- <div class="form-group">
                                <label for="first name">First Name</label>
                            <input type="text" name="first_name" class="form-control"  >

                           </div>

                            <div class="form-group">
                                <label for="last name">Last Name</label>
                            <input type="text" name="last_name" class="form-control" >

                           </div> -->

                           <div class="form-group">
                               <label for="email">Email</label>
                           <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">

                          </div>


                            <div class="form-group">
                                <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">

                           </div>

                            <div class="form-group">

                            <a id="user-id" class="btn btn-danger" href="">Delete</a>

                            <input type="submit" name="update_user" class="btn btn-primary pull-right" value="Update" >

                           </div>




                        </div>



            </form>
