 <div class="well">
     <h4>Leave a Comment:</h4>
     <form method="POST" action="">
         <div class="form-group  <?php echo $message['authorClass'] ?>">
             <label for="comment_author">Author</label>
             <input type="text" name="comment_author" class="form-control">
             <?php if ($message != null) {
                    echo "<span> {$message['author']} </span>";
                }
                ?>
         </div>

         <div class="form-group  <?php echo $message['emailClass'] ?>">
             <label for="comment_email">Email</label>
             <input type="text" name="comment_email" class="form-control">
             <?php if ($message != null) {
                    echo "<span> {$message['email']} </span>";
                }
                ?>
         </div>

         <div class="form-group <?php echo $message['contentClass'] ?>">
             <label for="comment_email">Content</label>
             <textarea class="form-control" rows="3" name="comment_content"></textarea>
             <?php if ($message != null) {
                    echo "<span> {$message['content']} </span>";
                }
                ?>
         </div>

         <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
     </form>
 </div>
 <hr>