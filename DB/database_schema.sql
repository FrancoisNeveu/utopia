BEGIN TRANSACTION;
CREATE TABLE sqlite_sequence(name,seq);
CREATE TABLE user (
    "id" INTEGER NOT NULL,
    "name" TEXT NOT NULL,
    "email" TEXT,
    "surname" TEXT,
    "token" TEXT
);
COMMIT;
