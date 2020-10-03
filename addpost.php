<div class="new_post">
  <button type="button" id="dodaj_post" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    <img src="uploads/write_post_index.png" alt="add_post" class="addpost_slika">
  </button>

  <div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
      <div class='modal-dialog' role='document'>
        <div class='modal-content'>
          <div class='modal-header'>
            <h5 class='modal-title' id='exampleModalLabel'>New Message</h5>
            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>
          <div class='modal-body'>
            <form class="" action="addpost_verify.php" enctype="multipart/form-data" method="post">
              <input type="text" name="description" value="" placeholder="What's on your mind?" required><br>
              Add an Image: <input type="file" name="slika" value=""><br>
              <input type="submit" name="submit" value="POST">
            </form>
          </div>
          <div class='modal-footer'>
            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
          </div>
        </div>
      </div>
    </div>
</div>
