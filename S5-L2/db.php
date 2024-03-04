<?php

    $db = 'teoria_session_cookie';
    $config = [
        'mysql_host' => 'localhost',
        'mysql_user' => 'php_user',
        'mysql_password' => 'password'
    ];

    $mysqli = new mysqli(
        $config['mysql_host'],
        $config['mysql_user'],
        $config['mysql_password']);

    if($mysqli->connect_error) { die($mysqli->connect_error); } 

    // Creo il mio DB
    $sql = 'CREATE DATABASE IF NOT EXISTS ' . $db;
    if(!$mysqli->query($sql)) { die($mysqli->connect_error); }

    // Seleziono il DB
    $sql = 'USE ' . $db;
    $mysqli->query($sql);

    // Creo la tabella
    $sql = 'CREATE TABLE IF NOT EXISTS users ( 
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        firstname VARCHAR(255) NOT NULL, 
        lastname VARCHAR(255) NOT NULL, 
        city VARCHAR(255) NOT NULL, 
        email VARCHAR(100) NOT NULL UNIQUE,
        lang VARCHAR(50) NOT NULL,
        password VARCHAR(255) NOT NULL 
    )';
    if(!$mysqli->query($sql)) { die($mysqli->connect_error); }

    //creo tabella traduzioni
    $drop = 'DROP TABLE IF EXISTS dizionario';
    $sql2 = 'CREATE TABLE dizionario ( 
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        IT TEXT(60000), 
        EN TEXT(60000) 
    )';
        // print($sql2);
    if(!$mysqli->query($drop)) { die($mysqli->connect_error); } 
    if(!$mysqli->query($sql2)) { die($mysqli->connect_error); } 


    //Inserisco traduzioni
    $traduzioni= 'INSERT INTO dizionario (IT, EN) VALUES ("Lingua", "Languages"), ("Cerca", "Search")';

    if(!$mysqli->query($traduzioni)) { die($mysqli->connect_error); } 

    // print($traduzioni); 

    //Creo tabella news
    // Creo la tabella
    $sql3 = 'CREATE TABLE IF NOT EXISTS news ( 
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        titolo_it VARCHAR(255), 
        titolo_eng VARCHAR(255), 
        body_it TEXT(55255), 
        body_eng TEXT(55100),
        img TEXT(5550)
    )';

    if(!$mysqli->query($sql3)) { die($mysqli->connect_error); }


    // Aggiungo una news
    $sql4 = 'SELECT * FROM news;';
    $res2 = $mysqli->query($sql4); // return un mysqli result
    if($res2->num_rows === 0) { 
        $sql4= 'INSERT INTO news (titolo_it, titolo_eng, body_it, body_eng, img) 
        VALUES ("Nuova scoperta archeologica a Pompei", "", "R2xpIGFudGljaGkgc2NhdmkgZGkgUG9tcGVpLCBnacOgIG5vdGkgcGVyIGxlIGxvcm8gc3RyYW9yZGluYXJpZSBzY29wZXJ0ZSBzdG9yaWNoZSwgaGFubm8gcmVjZW50ZW1lbnRlIGNhdHR1cmF0byBsJ2F0dGVuemlvbmUgZGVsIG1vbmRvIGNvbiB1bmEgcml2ZWxhemlvbmUgY2hlIGdldHRhIG51b3ZhIGx1Y2Ugc3VsbGEgcmljY2Egc3RvcmlhIGRlbGxhIHJlZ2lvbmUuIE5lbCBjdW9yZSBkZWxsJ2FudGljYSBjaXR0w6Agc2Vwb2x0YSBzb3R0byBsZSBjZW5lcmkgZGVsIFZlc3V2aW8sIGdsaSBhcmNoZW9sb2dpIGhhbm5vIHNjb3BlcnRvIHVuIG51b3ZvIHNpdG8gZGkgZ3JhbmRlIGltcG9ydGFuemEgc3RvcmljYSwgZ2V0dGFuZG8gdWx0ZXJpb3JpIGRldHRhZ2xpIHN1bGxhIHZpdGEgcXVvdGlkaWFuYSBlIHN1bGxlIHNmYWNjZXR0YXR1cmUgZGVsbGEgc29jaWV0w6Agcm9tYW5hLg==", "QXJjaGFlb2xvZ2ljYWwgZXhjYXZhdGlvbnMgaW4gUG9tcGVpaSBoYXZlIHVuZWFydGhlZCBhIHNpdGUgb2YgaW1tZW5zZSBoaXN0b3JpY2FsIHNpZ25pZmljYW5jZSwgdW52ZWlsaW5nIGEgbmV3IGNoYXB0ZXIgaW4gdGhlIGNhcHRpdmF0aW5nIG5hcnJhdGl2ZSBvZiB0aGlzIGFuY2llbnQgUm9tYW4gY2l0eSBmcm96ZW4gaW4gdGltZS4gTmVzdGxlZCBiZW5lYXRoIGxheWVycyBvZiB2b2xjYW5pYyBhc2ggYW5kIHB1bWljZSBmb3IgbmVhcmx5IHR3byBtaWxsZW5uaWEsIHRoZSBsYXRlc3QgZGlzY292ZXJ5IHByb21pc2VzIHRvIGVucmljaCBvdXIgdW5kZXJzdGFuZGluZyBvZiBQb21wZWlpJ3MgdmlicmFudCBwYXN0IGFuZCBzaGVkIGxpZ2h0IG9uIHRoZSBsaXZlcyBvZiBpdHMgaW5oYWJpdGFudHMuCgpUaGUgZXhjYXZhdGlvbiwgY29uZHVjdGVkIGJ5IGEgdGVhbSBvZiBkZWRpY2F0ZWQgYXJjaGFlb2xvZ2lzdHMsIGJlZ2FuIHdpdGggbWV0aWN1bG91cyBwbGFubmluZyBhbmQgc3lzdGVtYXRpYyBleHBsb3JhdGlvbiBvZiB0aGUgYXJlYSBiZWxpZXZlZCB0byBob2xkIHNlY3JldHMgYnVyaWVkIGJlbmVhdGggdGhlIGFzaGVzIG9mIE1vdW50IFZlc3V2aXVzJyBjYXRhc3Ryb3BoaWMgZXJ1cHRpb24gaW4gNzkgQUQuIEFzIGxheWVycyB3ZXJlIGNhcmVmdWxseSBwZWVsZWQgYXdheSwgdGhlIHJlbW5hbnRzIG9mIGFuY2llbnQgc3RyZWV0cywgYnVpbGRpbmdzLCBhbmQgYXJ0aWZhY3RzIGVtZXJnZWQsIG9mZmVyaW5nIHRhbnRhbGl6aW5nIGdsaW1wc2VzIGludG8gUG9tcGVpaSdzIGJ1c3RsaW5nIHVyYmFuIGxhbmRzY2FwZS4KCkF0IHRoZSBoZWFydCBvZiB0aGUgbmV3bHkgdW5lYXJ0aGVkIHNpdGUgbGllcyBhIGNvbXBsZXggb2Ygd2VsbC1wcmVzZXJ2ZWQgc3RydWN0dXJlcywgaW5jbHVkaW5nIHJlc2lkZW50aWFsIGR3ZWxsaW5ncywgcHVibGljIGJ1aWxkaW5ncywgYW5kIGNvbW1lcmNpYWwgZXN0YWJsaXNobWVudHMuIEVhY2ggZWRpZmljZSB0ZWxscyBhIHN0b3J5IG9mIGRhaWx5IGxpZmUgaW4gUG9tcGVpaSwgZnJvemVuIGluIHRpbWUgYnkgdGhlIGNhdGFjbHlzbWljIGV2ZW50IHRoYXQgZW5ndWxmZWQgdGhlIGNpdHkgaW4gYSB0b3JyZW50IG9mIHZvbGNhbmljIGRlYnJpcy4KCkFtb25nIHRoZSBtb3N0IHJlbWFya2FibGUgZmluZHMgaXMgYSBsYXZpc2hseSBhZG9ybmVkIHZpbGxhLCBhZG9ybmVkIHdpdGggZXhxdWlzaXRlIGZyZXNjb2VzLCBpbnRyaWNhdGUgbW9zYWljcywgYW5kIG9wdWxlbnQgZnVybmlzaGluZ3MsIGF0dGVzdGluZyB0byB0aGUgYWZmbHVlbmNlIGFuZCBzb3BoaXN0aWNhdGlvbiBvZiBpdHMgb2NjdXBhbnRzLiBTY2VuZXMgZGVwaWN0ZWQgb24gdGhlIHdhbGxzIG9mZmVyIGEgdml2aWQgdGFibGVhdSBvZiBhbmNpZW50IFJvbWFuIGxpZmUsIGNhcHR1cmluZyBtb21lbnRzIG9mIGxlaXN1cmUsIGNvbW1lcmNlLCBhbmQgY3VsdHVyYWwgZXhjaGFuZ2UuCgpBZGphY2VudCB0byB0aGUgdmlsbGEsIGFyY2hhZW9sb2dpc3RzIHVuY292ZXJlZCBhIHNlcmllcyBvZiBpbnRlcmNvbm5lY3RlZCBjb3VydHlhcmRzIGFuZCBnYXJkZW5zLCBvbmNlIHZpYnJhbnQgb2FzZXMgb2YgZ3JlZW5lcnkgYW5kIHRyYW5xdWlsaXR5IGFtaWRzdCB0aGUgYnVzdGxpbmcgY2l0eXNjYXBlLiBGcmFnbWVudHMgb2YgbWFyYmxlIHN0YXR1ZXMsIGRlY29yYXRpdmUgZm91bnRhaW5zLCBhbmQgb3JuYW1lbnRhbCBwbGFudGluZ3MgZXZva2UgYSBzZW5zZSBvZiB0aGUgb3B1bGVuY2UgYW5kIHJlZmluZW1lbnQgdGhhdCBjaGFyYWN0ZXJpemVkIFBvbXBlaWFuIHNvY2lldHkuCgpGdXJ0aGVyIGV4cGxvcmF0aW9uIHJldmVhbGVkIGV2aWRlbmNlIG9mIGluZHVzdHJpYWwgYWN0aXZpdHksIHdpdGggd29ya3Nob3BzIGFuZCBtYW51ZmFjdHVyaW5nIGZhY2lsaXRpZXMgeWllbGRpbmcgdG9vbHMsIHBvdHRlcnksIGFuZCBvdGhlciBhcnRpZmFjdHMgaW5kaWNhdGl2ZSBvZiBQb21wZWlpJ3MgdGhyaXZpbmcgZWNvbm9teS4gRnJvbSBidXN0bGluZyBtYXJrZXRwbGFjZXMgdG8gYnVzdGxpbmcgd29ya3Nob3BzLCB0aGUgY2l0eSBidXp6ZWQgd2l0aCB0aGUgZW5lcmd5IG9mIGNvbW1lcmNlIGFuZCBjcmFmdHNtYW5zaGlwLCBhcyBhcnRpc2FucyBob25lZCB0aGVpciBza2lsbHMgYW5kIG1lcmNoYW50cyB0cmFkZWQgZ29vZHMgZnJvbSBkaXN0YW50IGxhbmRzLgoKSW4gYWRkaXRpb24gdG8gaXRzIGFyY2hpdGVjdHVyYWwgbWFydmVscyBhbmQgbWF0ZXJpYWwgd2VhbHRoLCB0aGUgbmV3bHkgZXhjYXZhdGVkIHNpdGUgb2ZmZXJzIGludmFsdWFibGUgaW5zaWdodHMgaW50byBQb21wZWlpJ3Mgc29jaWFsIGR5bmFtaWNzIGFuZCBjdWx0dXJhbCBkaXZlcnNpdHkuIEdyYWZmaXRpIHNjcmF3bGVkIG9uIHRoZSB3YWxscywgaW5zY3JpcHRpb25zIGV0Y2hlZCBpbiBzdG9uZSwgYW5kIHBlcnNvbmFsIGJlbG9uZ2luZ3MgbGVmdCBiZWhpbmQgYnkgcmVzaWRlbnRzIHByb3ZpZGUgZ2xpbXBzZXMgaW50byB0aGVpciBpZGVudGl0aWVzLCBhc3BpcmF0aW9ucywgYW5kIGRhaWx5IHN0cnVnZ2xlcy4KClRoZSBkaXNjb3Zlcnkgb2YgdGhpcyByZW1hcmthYmxlIHNpdGUgdW5kZXJzY29yZXMgdGhlIG9uZ29pbmcgaW1wb3J0YW5jZSBvZiBhcmNoYWVvbG9naWNhbCByZXNlYXJjaCBpbiB1bnJhdmVsaW5nIHRoZSBteXN0ZXJpZXMgb2YgdGhlIHBhc3QgYW5kIHByZXNlcnZpbmcgdGhlIGN1bHR1cmFsIGhlcml0YWdlIG9mIGFuY2llbnQgY2l2aWxpemF0aW9ucy4gQnkgcGllY2luZyB0b2dldGhlciB0aGUgZnJhZ21lbnRzIG9mIFBvbXBlaWkncyBoaXN0b3J5LCB3ZSBjYW4gZ2FpbiBhIGRlZXBlciBhcHByZWNpYXRpb24gZm9yIHRoZSByZXNpbGllbmNlIG9mIGh1bWFuaXR5IGluIHRoZSBmYWNlIG9mIGFkdmVyc2l0eSBhbmQgdGhlIGVuZHVyaW5nIGxlZ2FjeSBvZiBhIGNpdHkgbG9zdCBpbiB0aW1lLgoKQXMgZXhjYXZhdGlvbnMgY29udGludWUgYW5kIGZ1cnRoZXIgZGlzY292ZXJpZXMgYXJlIG1hZGUsIHRoZSBzdG9yeSBvZiBQb21wZWlpIHdpbGwgY29udGludWUgdG8gY2FwdGl2YXRlIGFuZCBpbnNwaXJlIGdlbmVyYXRpb25zIHRvIGNvbWUsIG9mZmVyaW5nIGEgd2luZG93IGludG8gdGhlIHJpY2ggdGFwZXN0cnkgb2YgaHVtYW4gZXhwZXJpZW5jZSBhbmQgdGhlIGVuZHVyaW5nIHF1ZXN0IGZvciBrbm93bGVkZ2UgYW5kIHVuZGVyc3RhbmRpbmcu", "https://media.istockphoto.com/id/1058157586/photo/vesuvius-and-pompeii.jpg?s=612x612&w=0&k=20&c=XVFT8kJdyo0AQRwqUDaGbz04ckKvIjkVsLb2ZscdzmE=");';
        if(!$mysqli->query($sql4)) { echo($mysqli->connect_error); }
        else { echo 'Record aggiunto con successo!!!';}
    }



    // Leggo dati da una tabella
    $sql = 'SELECT * FROM users;';
    $res = $mysqli->query($sql); // return un mysqli result
    if($res->num_rows === 0) { 
        $password = password_hash('Pa$$w0rd!' , PASSWORD_DEFAULT);
        // Inserisco dati in una tabella
        $sql = 'INSERT INTO users (firstname, lastname, city, email, password, lang) 
            VALUES ("Mario", "Rossi", "Roma", "m.rossi@example.com", "'.$password.'", "IT");';
        if(!$mysqli->query($sql)) { echo($mysqli->connect_error); }
        else { echo 'Record aggiunto con successo!!!';}
    }