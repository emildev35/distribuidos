<?php
if (!isset($_POST)) {

}
include_once __DIR__."/../layout/header.php";
?>
<form class="form" action="" method="post">
    <input type="text" name="nombre" id="nombre" value="" />
    <select name="tramites" id="tramites" multiple onchange="" size="1">
        <option value="option2">option2</option>
    </select>
</form>
<table class="table">
<thead>
    <tr><td>Nombre</td></tr>
</thead>
   <tbody>
   </tbody> 
</table>
<?php
include_once __DIR__."/../layout/footer.php";
