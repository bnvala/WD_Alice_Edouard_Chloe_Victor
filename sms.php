<!DOCTYPE html>
<html>
<head>
        <title>SMS avec PHP</title>
</head>
<body>
    <form method="post">
        <label>NUMERO</label>
        <input type ="text" name ="num">
        <br><br>
        <label>Code Pays</label>
        <select name="code">
            <option value="">SELECT here...</option>
            <option value = "33">France - +33</option>
        </select>
        <br><br>
        <label>Entrer le message</label>
        <input type="text" name ="message">
        <input type="submit" name ="submit">
</form>
</body>
</html>