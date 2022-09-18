CREATE OR REPLACE PROCEDURE get_latest_film() LANGUAGE plpgsql AS
$$ 
	DECLARE title TEXT;
	
	BEGIN 
		SELECT fl.title INTO title FROM film_list fl ORDER BY fid DESC LIMIT 1;
		RAISE NOTICE 'Latest film: %', title;
	END;
$$

CALL get_latest_film();

SELECT r.routine_body, r.specific_name FROM information_schema."routines" r; -- WHERE r.routine_type; LIKE '%PROC%'
SELECT * FROM pg_catalog.pg_proc WHERE proname LIKE '%get_latest_film%';

DROP PROCEDURE show_function_definition;