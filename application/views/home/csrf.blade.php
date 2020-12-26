<form action="csrf" method="post">
    {{ Form::token(); }}
    <input type="submit" value="OK">
</form>