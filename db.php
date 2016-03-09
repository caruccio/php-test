<h3>Run sql</h3>
<form method=post>
    <label>
        <input type=text name="text" value=""/> <input type=submit value="Run SQL"/>
    </label>
</form>


<h3>Navigate</h3>
<?php
$dbhost = getenv('DATABASE_SERVICE_NAME') ?: "mysql";
$dbuser = getenv('MYSQL_USER');
$dbpass = getenv('MYSQL_PASSWORD');

$link = mysqli_connect($dbhost, $dbuser, $dbpass);

// notice: no error handling for the sake of simplicity

function run_sql($sql)
{
    $res = mysqli_query($link, $sql);
    print_r(mysqli_fetch_all($res));
}

function list_databases($link)
{
    $sql = "SHOW DATABASES";
    $res = mysqli_query($link, $sql);
    $databases = array();

    while ($row = mysqli_fetch_row($res)) {
        if (($row[0] != "information_schema")
           && ($row[0] != "mysql")
           && ($row[0] != "performance_schema")) {
            $databases[] = $row[0];
        }
    }

   return $databases;
}

function ask_database($link)
{
    echo "Selecione a base: ";
    $databases = list_databases($link);
    foreach ($databases as $db) {
        echo "<a href=\"?db=$db\">$db</a> ";
    }
    echo "\n";
}

function list_tables($link, $db)
{
    $sql = "SHOW TABLES";
    $res = mysqli_query($link, $sql);
    $tables = array();

    while ($row = mysqli_fetch_row($res)) {
        $tables[] = $row[0];
    }

   return $tables;
}

function ask_table($link, $db)
{
    echo "Selecione a tabela ($db): ";
    $tables = list_tables($link, $db);
    foreach ($tables as $table) {
        echo "<a href=\"?db=$db&table=$table\">$table</a> ";
    }
    echo "\n";
}

function dump_table($link, $db, $table)
{
    echo "Conteúdo da tabela ($db.$table)<br>";
    $sql = "SELECT * from $table";
    $res = mysqli_query($link, $sql);

    //list field names
    $fields  = mysqli_fetch_fields($res);

    echo "<table>\n";
    echo "  <th>\n";
    foreach ($fields as $field) {
        echo "    <td>$field->name ($field->type)</td>\n";
    }
    echo "  </th>\n";
    echo "</table>\n";

}

if ($_POST["sql"]) {
    echo "SQL: $_POST[sql]<br>";
    echo "Result:<br>";
    run_sql($_POST["sql"]);
    exit(0);
}

if ($_GET["db"]) {
    $db = $_GET["db"];
    mysqli_select_db($link, $db);
} else {
    $link = mysqli_connect($dbhost, $dbuser, $dbpass);
    ask_database($link);
    exit(0);
}


if ($_GET["table"]) {
    $table = $_GET["table"];
} else {
    ask_table($link, $db);
    exit(0);
}

dump_table($link, $db, $table);
?>
