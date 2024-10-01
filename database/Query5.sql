SELECT s.song_id, s.album_name, a.thumbnail
FROM song AS s
INNER JOIN album AS a ON a.album_name = s.album_name;



SELECT s.song_id, s.album_name, a.thumbnail
FROM song AS s
INNER JOIN album AS a ON a.album_name = s.album_name
WHERE s.title LIKE '%gravity%';

use Sonix;
delimiter $$
create procedure search(in titl varchar(100))
begin
select s.song_id,s.album_name,a.thumbnail
from song as s
inner join album as a on a.album_name=s.album_name
where s.title like titl or s.album_name like titl;
end $$

call search('%gravity%');

delimiter //
create procedure example()
begin
	select * from song;
    select * from album;
end//
update song set likes=likes+1 where song_id=21;
drop procedure song_like;
DELIMITER //

CREATE PROCEDURE song_like(IN table_name VARCHAR(100), IN id BIGINT)
BEGIN
    -- Construct the INSERT statement
    SET @orig_sql_safe_updates = @@SQL_SAFE_UPDATES;
    SET @orig_foreign_key_checks = @@FOREIGN_KEY_CHECKS;
    SET SQL_SAFE_UPDATES = 0;
    SET FOREIGN_KEY_CHECKS = 0;

    SET @insertStmt = CONCAT(
        'INSERT INTO ', table_name, '_liked VALUES(', id, ');'
    );

    -- Construct the UPDATE statement
    SET @updateStmt = CONCAT(
        'UPDATE song SET likes = likes + 1 WHERE song_id = ', id, ';'
    );

    -- Prepare, execute, and deallocate the INSERT statement
    PREPARE stmt1 FROM @insertStmt;
    EXECUTE stmt1;
    DEALLOCATE PREPARE stmt1;

    -- Prepare, execute, and deallocate the UPDATE statement
    PREPARE stmt2 FROM @updateStmt;
    EXECUTE stmt2;
    DEALLOCATE PREPARE stmt2;
    
     SET FOREIGN_KEY_CHECKS = @orig_foreign_key_checks;
    SET SQL_SAFE_UPDATES = @orig_sql_safe_updates;

END //


-- Call the stored procedure
CALL song_like('sanjay19', 21);

drop procedure song_like;

call song_like('sanjay19',21);

DELIMITER //

CREATE PROCEDURE force_delete_song(IN id BIGINT)
BEGIN
    -- Disable foreign key checks
    SET FOREIGN_KEY_CHECKS = 0;

    -- Perform the delete operation
    DELETE FROM song WHERE song_id = id;

    -- Re-enable foreign key checks
    SET FOREIGN_KEY_CHECKS = 1;
END //

DELIMITER ;

-- Call the stored procedure
CALL force_delete_song(21);


select s.title from song as s
inner join sanjay19_liked as l on s.song_id=l.song_id;

delete l from sanjay19_liked l
left join song s on l.song_id=s.song_id
where s.song_id is null;

delimiter //
create procedure update_liked_table(in table_name varchar(100))
BEGIN
  -- Define the table structure (replace with your desired columns)
  SET @createTableStmt = CONCAT(
    'delete l from ',table_name,'_liked l
	left join song s on l.song_id=s.song_id
	where s.song_id is null;'
  );

  -- Prepare and execute the CREATE TABLE statement
  PREPARE stmt FROM @createTableStmt;
  EXECUTE stmt;
  DEALLOCATE PREPARE stmt;

END //


drop procedure update_liked_table