<h1>Edit Game</h1>
<form action="/game/edit/<?php echo $id; ?>" method="post">
Name : <input type="text" id="name" name="name" value="<?php echo $name; ?>" />
<input type="submit" value="Save"  />
</form>
<a href="/game/">Regresar</a>