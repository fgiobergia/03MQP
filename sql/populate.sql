INSERT INTO MACHINES (MId, Name) VALUES
    (1, 'Machine 1'),
    (2, 'Machine 2'),
    (3, 'Machine 3'),
    (4, 'Machine 4');

INSERT INTO USERS (UId, FirstName, LastName, Email, Password) VALUES
    (1, 'James', 'Smith', 'u1@p.it', 'b87e31fca3b6e7f453b3339739411fe579fc0eb1e3cd2e11ed54be0d4c9c91f93195b212ee9f07246b0b069f92d2feb0a349caba41aef78bb2655276f325d96b'),
    (2, 'Robert', 'Johnson', 'u2@p.it', 'bf5782c4bae74d23912a4dbafe13650ef3edd9923d01836909ce05e589d127b3f1517f282c4659599ee9447225bca1a47b0addb42445b954b443fc1ee5a7f3dc'),
    (3, 'Liam', 'Williams', 'u3@p.it', '91bc731ce5b957bbbb86979e732703caea8fb96cee3dd1a5fc3c8b7306e78e50eef2511391589a41c889de84724f0644fe06147ebb968f330e70c082a5381ee1');

INSERT INTO RESERVATIONS (UId, MId, StartTime, Duration) VALUES
    (1, 1, 510, 30),
    (1, 3, 570, 30),
    (2, 2, 630, 30),
    (2, 4, 690, 30),
    (3, 1, 750, 30),
    (3, 4, 810, 30),
    (1, 2, 930, 60),
    (2, 3, 960, 60);
