@include("menu")
<H1>Add A New News Item</H1>
<form action="" method="POST">

    @csrf

    <label>Title: <input type="text" name="title"></label><br>
    <label>Detail description: <textarea name="description"></textarea></label><br>
    <label>Short description: <textarea name="shortDescription"></textarea></label><br>
    <input type="submit" value="Add">
</form>