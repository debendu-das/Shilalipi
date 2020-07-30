<div class="container">
        <div class="row">
            <div class="col-12 col-md-10 offset-3">
              <form action="./addnew.php" enctype="multipart/form-data" method="POST">

                  <div class="form-group">
                      <label for="Title">Title</label>
                      <input type="text" class="form-control" id="textinput" name="blog_title" placeholder="Blog Title">
                  </div>

                  <div class="form-group">
                      <label for="categorie">Categorie</label>
                      <input type="text" class="form-control" id="catinput" name="blog_cat" placeholder="Blog Categorie">
                  </div>

                  <div class="form-group">
                      <label for="blogimg">Blog Image</label>
                      <input type="file" name="blog_img">
                  </div>

                  <div class="form-group">
                      <label for="blogcontent">Blog Content</label>
                      <!-- <div id="summernote"></div> -->
                      <textarea name="blog_content" id="summernote">Write Your Blog Here !</textarea>
                  </div>

                  <div class="form-group">
                      <label for="tags">Blog Tags</label><span class="text-muted">   Add comma(,) separete values</span>
                      <input type="text" class="form-control" id="blog_tag" name="blog_tag">
                  </div>
                  <input type="submit" name="publish" value="Publish Post"  class="btn btn-primary">
              </form>
            </div>
        </div>
    </div>
