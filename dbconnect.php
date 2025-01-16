<?php
try {
    $host = "localhost";
    $port = "5432";
    $dbName = "tugon_db";
    $username = "postgres";
    $password = "admin";

    $dsnDb = "pgsql:host=$host;port=$port;dbname=$dbName";
    try {
        $pdo = new PDO($dsnDb, $username, $password);
    } catch (PDOException $e) {
        $dsn = "pgsql:host=$host;port=$port";
        $pdo = new PDO($dsn, $username, $password);
        $createDbQuery = "CREATE DATABASE $dbName";
        $pdo->exec($createDbQuery);
        $pdo = new PDO($dsnDb, $username, $password);
    }

    $userListTableCheck = "SELECT EXISTS (
        SELECT FROM information_schema.tables 
        WHERE table_schema = 'public' AND table_name = 'user_list'
    )";
    $stmt = $pdo->query($userListTableCheck);
    $userListTableExists = $stmt->fetchColumn();

    if (!$userListTableExists) {
        $createUserListTableQuery = "
            CREATE TABLE user_list (
                user_id SERIAL PRIMARY KEY,
                username VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL,
                user_type VARCHAR(20) NOT NULL CHECK (user_type IN ('resident', 'official'))
            );
        ";
        $pdo->exec($createUserListTableQuery);
    }

    $resourceListTableCheck = "SELECT EXISTS (
        SELECT FROM information_schema.tables 
        WHERE table_schema = 'public' AND table_name = 'resource_list'
    )";
    $stmt = $pdo->query($resourceListTableCheck);
    $resourceListTableExists = $stmt->fetchColumn();

    if (!$resourceListTableExists) {
        $createResourceListTableQuery = "
            CREATE TABLE resource_list (
                resource_id SERIAL PRIMARY KEY,
                resource_name VARCHAR(255) NOT NULL,
                resource_amount VARCHAR(255) NOT NULL
            );
        ";
        $pdo->exec($createResourceListTableQuery);
    }

    $incidentListsTableCheck = "SELECT EXISTS (
        SELECT FROM information_schema.tables 
        WHERE table_schema = 'public' AND table_name = 'incident_lists'
    )";
    $stmt = $pdo->query($incidentListsTableCheck);
    $incidentListsTableExists = $stmt->fetchColumn();

    if (!$incidentListsTableExists) {
        $createIncidentListsTableQuery = "
            CREATE TABLE incident_lists (
                incident_id SERIAL PRIMARY KEY,
                reporter_name VARCHAR(255) NOT NULL,
                incident_type VARCHAR(255) NOT NULL CHECK (
                    incident_type IN (
                        'Drought', 'Earthquake', 'Extreme Heat', 'Flood', 'Fire', 
                        'Heavy Rainfall', 'Landslide', 'Storm Surge', 'Tsunami', 
                        'Typhoon', 'Volcanic Eruption', 'Other'
                    ) OR incident_type IS NOT NULL
                ),
                custom_incident_type VARCHAR(255),
                incident_datetime TIMESTAMP NOT NULL,
                location VARCHAR(255) NOT NULL,
                description TEXT NOT NULL,
                supporting_files VARCHAR(255),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );
        ";
        $pdo->exec($createIncidentListsTableQuery);
    }

    $brgyDetailTableCheck = "SELECT EXISTS (
        SELECT FROM information_schema.tables 
        WHERE table_schema = 'public' AND table_name = 'brgy_detail'
    )";
    $stmt = $pdo->query($brgyDetailTableCheck);
    $brgyDetailTableExists = $stmt->fetchColumn();

    if (!$brgyDetailTableExists) {
        $createBrgyDetailTableQuery = "
            CREATE TABLE brgy_detail (
                barangay_id SERIAL PRIMARY KEY,
                barangay_name VARCHAR(255) NOT NULL,
                city_name VARCHAR(255) NOT NULL,
                province_name VARCHAR(255) NOT NULL,
                barangay_logo VARCHAR (255)
            );
        ";
        $pdo->exec($createBrgyDetailTableQuery);
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
