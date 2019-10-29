<?php

    $servername = "localhost:3306";
    $username = "root";
    $password = "NYg1@nts";
    $dbname = "assignment";

    //Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    //Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    sleep(1);

    //Function to display names of users
    function display_names($sql, $conn) {
      $result = $conn->query($sql);
      while($row = $result -> fetch_assoc()) {
        sleep(1);
        echo $row["name"] . "\n";
      }
    }

    //     1. Find users that are not assigned to any company
    $sql_1 = "SELECT name FROM users WHERE companyId IS NULL;";
    echo "Users not assigned to any company:\n";
    sleep(1);
    display_names($sql_1, $conn);
    sleep(1);
    echo "\n";

    //     2. Find active (not deleted) users who are assigned to inactive (deleted) companies
    $sql_2 = "SELECT u.name name
            FROM users u
            JOIN companies c
            ON u.companyId = c.id
            WHERE u.isDeleted != 1 AND c.isDeleted = 1;";
    echo "Active users assigned to inactive companies:\n";
    sleep(1);
    display_names($sql_2, $conn);
    sleep(1);
    echo "\n";

    //     3. Find out how many active (not deleted) users are assigned to each active (not deleted)
    //     company. Display the list of company names and the number of active users in
    //     descending order.
    $sql_3 = "SELECT c.name company, COUNT(u.id) users
      FROM users u
      JOIN companies c
      ON u.companyId = c.id
      WHERE u.isDeleted != 1 AND c.isDeleted != 1
      GROUP BY company
      ORDER BY users DESC;";
    echo "Number of active users at each active company:\n";
    sleep(2);
    $result = $conn->query($sql_3);
    while($row = $result -> fetch_assoc()) {
      echo $row["company"] . "  - ";
      echo $row["users"] . "\n";
    }
    echo "\n";


    //     4. Find users that are assigned to a non-existent company.
    $sql_4 = "SELECT u.name name
      FROM users u
      LEFT JOIN companies c
      ON u.companyId = c.id
      WHERE c.id is NULL AND u.companyId is NOT NULL";
    sleep(1);
    echo "Users assigned to a non-existant company:\n";
    sleep(1);
    display_names($sql_4, $conn);
    sleep(1);
    echo "\n";

    //     5. Create a new user, Leto, assigned to ‘A-Corp’ .
    $sql_insert = "INSERT INTO users (name, companyId) VALUES ('Leto', 1);";
    if ($conn->query($sql_insert) === TRUE) {
        echo "New user successfully created\n";
    } else {
        echo "Error: " . $sql . "\n" . $conn->error;
    }
    $sql_5 = "SELECT name FROM users WHERE name = 'Leto';";
    sleep(1);
    echo "We can now search for 'Leto' in the database:\n";
    sleep(1);
    display_names($sql_5, $conn);
    echo "\n";
    sleep(1);

    //     6. Change Leto’s name to Leo.
    // note: In a large dataset, it would be better to first run the commented-out query below, in order
    // to grab id(s) of users named 'Leto' in order to ensure there aren't multiple users named Leto
    // and we aren't inadvertently updating information of users that we didn't intend on updating.
    // However, for this exercise it was easy to confirm that there is only one user named "Leto"

    //"SELECT * FROM users WHERE name = 'Leto';"
    $sql_update = "UPDATE users SET name = 'Leo' WHERE name = 'Leto';";
    if ($conn->query($sql_update) === TRUE) {
        echo "User updated successfully\n";
    } else {
        echo "Error: " . $sql . "\n" . $conn->error;
    }
    $sql_6 = "SELECT name FROM users WHERE name IN ('Leto', 'Leo');";
    sleep(1);
    echo "We can now see that Leto has been updated to Leo:\n";
    sleep(1);
    display_names($sql_6, $conn);
    echo "\n";

    //     7. Delete user Bob
    // note: similar to the query above, it would be better to first find the ids of all users,
    // named Bob to make sure there aren't multiple Bob's and that we are marking the correct user
    // as deleted. However, for this exercise it was easy to confirm that there is only one "Bob"

    //"SELECT * FROM users WHERE name = 'Bob';"
    $sql_mark_deleted = "UPDATE users SET isDeleted = True WHERE name = 'Bob';";
    if ($conn->query($sql_mark_deleted) === TRUE) {
        echo "User successfully was marked deleted\n";
    } else {
        echo "Error: " . $sql . "\n" . $conn->error;
    }
    $sql_7 = "SELECT name, isDeleted FROM users WHERE name = 'Bob';";
    $result = $conn->query($sql_7);
    sleep(1);
    echo "User - isDeleted\n";
    while($row = $result -> fetch_assoc()) {
      echo $row["name"] . "  - ";
      echo $row["isDeleted"] . "\n";
    }

    //close db connection
    $conn->close();
?>
