<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">

    <a data-toggle="modal" data-id="<?php echo 'Hekmat'; ?>" title="Add this item" class="open-AddBookDialog btn btn-primary" href="#addBookDialog">test</a>
    <div class="modal" id="addBookDialog" class="modal fade">
        <div class="modal-header">
            <button class="close" data-dismiss="modal">×</button>
            <h3>Modal header</h3>
        </div>
        <div class="modal-body">
            <p>some content</p>
            <input type="text" name="bookId" id="bookId" value=""/>
        </div>
    </div>

</div>



<script>
$(document).on("click", ".open-AddBookDialog", function () {
var myBookId = $(this).data('id');
$(".modal-body #bookId").val( myBookId );
// As pointed out in comments,
// it is superfluous to have to manually call the modal.
// $('#addBookDialog').modal('show');
});
</script>



</body>
</html>