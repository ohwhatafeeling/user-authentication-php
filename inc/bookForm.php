<div class="form-group">
    <label for="title" class="col-sm-2 control-label">Title</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="title" name="title" placeholder="Book Title" value="<?php if(isset($bookTitle)) echo $bookTitle; ?>">
    </div>
</div>
<div class="form-group">
    <label for="description" class="col-sm-2 control-label">Description</label>
    <div class="col-sm-10">
        <textarea name="description" class="form-control" rows="5" placeholder="Description of the book"><?php if(isset($bookDescription)) echo $bookDescription; ?></textarea>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default"><?php if(isset($buttonText)) echo $buttonText; else echo 'Add Book'; ?></button>
    </div>
</div>
