----------------------------------1------------------------------------------
CREATE TABLE Users(
    uID INT(9) PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    dateofBirth DATE NOT NULL
    CHECK(YYYY<2007),
    Costume,
    UNIQUE(costume)
);
CREATE TABLE Conversations(
    cID  VARCHAR(12) PRIMARY KEY,
    hostID NOT NULL,
    topic VARCHAR(30),
    duration INT,
    CHECK(duration<121 AND duration>0)
);
CREATE TABLE Participated(
    uID INT(9) NOT NULL,
    cID VARCHAR(12) NOT NULL,
    PRIMARY KEY( uID, cID),
    grade FLOAT(20)
    CHECK(grade<11 AND grade>0),
    finished BINARY
    CHECK((finished=1 AND grade<10 AND grade>5)  OR (finished=0 grade<11 AND grade>0)),
);
---------------------------2----------------------------------------------------------
SELECT  u1.uID, u1.name, u1.DOB

FROM	Users u1 , Users u2

WHERE	'O' IN u1.name OR 'A' IN u1.name OR 'o' IN u1.name OR 'a' IN u1.name
AND u1.dob => u2.dob
AND u1.uID NOT IN ( SELECT uID
FROM Participated p)


_______________3_____________________










SELECT cID, duration
FROM Conversations c
WHERE c. cID IN
    (SELECT Participated. cID
    FROM Participated p1, Participated p2
    WHERE p1. cID = p2. cID
            AND NOT EXISTS
                    (SELECT *
                        FROM Participated p3, Conversations c1
                        WHERE p3. cID = p1. cID,
                        AND p3.ciD=c1.ciD,
                        AND p3.finished=0))
GROUP BY grade
HAVING avg(grade)<=7))
ORDER BY C. duration ASC;
